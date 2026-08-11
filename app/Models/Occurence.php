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

class Occurence extends Model implements ContractsAuditable
{
    //

    public const META = [
        "label" => "Wystąpienia",
        "icon" => "clipboard-text-clock",
        "description" => "Wpisy, kiedy dane wpisy zostały lub zostaną wykonane.",
        "role" => "entry-manager",
        "ordering" => 3,
    ];

    use HasStandardFields, HasStandardScopes, HasStandardAttributes;
    use SoftDeletes, Auditable;

    public $timestamps = false;

    #region presentation
    public function __toString(): string
    {
        return $this->date->diffForHumans();
    }

    public function optionLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => $this,
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
                ]),
                "slot" => $this,
            ])->render(),
        );
    }

    public function displaySubtitle(): Attribute
    {
        return Attribute::make(
            get: fn () => null,
        );
    }

    public function displayMiddlePart(): Attribute
    {
        return Attribute::make(
            get: fn () => view("shipyard::components.app.model.connections-preview", [
                "connections" => self::getConnections(),
                "model" => $this,
            ])->render(),
        );
    }
    #endregion

    #region fields
    public const FIELDS = [
        "date" => [
            "type" => "datetime-local",
            "label" => "Data wystąpienia",
            "icon" => "calendar",
        ],
    ];

    protected $fillable = [
        "entry_id",
        "date",
    ];
    #endregion

    #region relations
    public const CONNECTIONS = [
        "entry" => [
            "model" => Entry::class,
            "mode" => "one",
            "field_label" => "Wpis",
            "required" => true,
        ],
    ];

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }
    #endregion

    #region actions and extras
    #endregion

    #region scopes
    public function scopeVisible()
    {
        return $this;
    }

    public function scopeForConnection()
    {
        return $this->visible();
    }
    #endregion

    #region sorts and filters
    #endregion

    #region attributes and helpers
    protected function casts(): array
    {
        return [
            "date" => "datetime",
        ];
    }

    protected $appends = [

    ];
    #endregion

    #region on-saves
    #endregion
}
