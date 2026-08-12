<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\View\ComponentAttributeBag;
use Mattiverse\Userstamps\Traits\Userstamps;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;
use Wpwwhimself\Shipyard\Traits\HasStandardAttributes;
use Wpwwhimself\Shipyard\Traits\HasStandardFields;
use Wpwwhimself\Shipyard\Traits\HasStandardScopes;

class Subject extends Model implements ContractsAuditable
{
    //

    public const META = [
        "label" => "Tematy",
        "icon" => "folder-open",
        "description" => "Umożliwiają grupowanie i kategoryzowanie wpisów.",
        "role" => "entry-manager",
        "checkOwnerUnless" => "technical",
        "ordering" => 1,
        "defaultSort" => "name",
    ];

    use HasStandardFields, HasStandardScopes, HasStandardAttributes;
    use SoftDeletes, Userstamps, Auditable;

    #region presentation
    public function __toString(): string
    {
        return $this->name;
    }

    public function optionLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->name,
        );
    }

    public function displayTitle(): Attribute
    {
        return Attribute::make(
            get: fn () => view("shipyard::components.app.h", [
                "lvl" => 3,
                "icon" => $this->icon ?? self::META["icon"],
                "attributes" => new ComponentAttributeBag([
                    "role" => "card-title",
                    "style" => "color: {$this->color};",
                ]),
                "slot" => $this,
            ])->render(),
        );
    }

    public function displaySubtitle(): Attribute
    {
        return Attribute::make(
            get: fn () => view("shipyard::components.app.model.badges", [
                "badges" => $this->badges,
            ])->render(),
        );
    }

    public function displayMiddlePart(): Attribute
    {
        return Attribute::make(
            get: fn () => view("shipyard::components.app.icon-label-value", [
                "icon" => model_icon("entries"),
                "label" => "Liczba wpisów",
                "slot" => $this->entries()->count(),
            ])->render(),
        );
    }
    #endregion

    #region fields
    public const FIELDS = [
        "description" => [
            "type" => "TEXT",
            "label" => "Opis",
            "icon" => "text",
        ],
        "icon" => [
            "type" => "icon",
            "label" => "Ikona",
            "icon" => "image",
        ],
        "color" => [
            "type" => "color",
            "label" => "Kolor",
            "icon" => "palette",
        ],
    ];

    protected $fillable = [
        "name", "order",
        "description",
        "icon",
        "color",
    ];
    #endregion

    #region relations
    public const CONNECTIONS = [
        "entries" => [
            "model" => Entry::class,
            "mode" => "many-reverse",
        ],
    ];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
    #endregion

    #region actions and extras
    #endregion

    #region scopes
    public function scopeVisible()
    {
        return $this;
    }
    #endregion

    #region sorts and filters
    const SORTS = [
        "name" => [
            "label" => "Nazwa",
            "compare-using" => "field",
            "discr" => "name",
        ],
    ];
    #endregion

    #region attributes and helpers
    protected function casts(): array
    {
        return [
            //
        ];
    }

    protected $appends = [

    ];
    #endregion

    #region on-saves
    #endregion
}
