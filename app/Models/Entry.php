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

class Entry extends Model implements ContractsAuditable
{
    //

    public const META = [
        "label" => "Wpisy",
        "icon" => "tag-multiple",
        "description" => "Zdarzenia, których daty wykonania chcesz śledzić.",
        "role" => "entry-manager",
        "checkOwnerUnless" => "technical",
        "ordering" => 2,
    ];

    use HasStandardFields, HasStandardScopes, HasStandardAttributes;
    use SoftDeletes, Userstamps, Auditable;

    #region presentation
    public function __toString(): string
    {
        return implode(" ", [
            "<span style='color: {$this->subject->color};'>"
                . view("shipyard::components.app.icon", ["name" => $this->subject->icon])->render()
            . "</span>",
            implode(" / ", [$this->subject, $this->name]),
        ]);
    }

    public function optionLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => implode(" / ", [$this->subject, $this->name]),
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
                "slot" => $this->name,
            ])->render(),
        );
    }

    public function displaySubtitle(): Attribute
    {
        return Attribute::make(
            get: fn () => $this,
        );
    }

    public function displayMiddlePart(): Attribute
    {
        return Attribute::make(
            get: fn () => view("shipyard::components.app.values-preview", [
                "data" => [
                    [
                        "icon" => model_icon("occurences"),
                        "label" => "Liczba wystąpień",
                        "value" => $this->occurences()->count(),
                    ],
                    [
                        "icon" => "calendar-end",
                        "label" => "Najnowsze wystąpienie",
                        "value" => $this->occurences->last()?->date->diffForHumans(),
                    ],
                ],
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
    ];

    protected $fillable = [
        "name", "order",
        "description",
        "subject_id",
    ];
    #endregion

    #region relations
    public const CONNECTIONS = [
        "subject" => [
            "model" => Subject::class,
            "mode" => "one",
            "field_label" => "Temat",
            "required" => true,
        ],
        "occurences" => [
            "model" => Occurence::class,
            "mode" => "many-reverse",
        ],
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function occurences()
    {
        return $this->hasMany(Occurence::class)->orderBy("date");
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
    const FILTERS = [
        "subject" => [
            "label" => "Temat",
            "compare-using" => "field",
            "discr" => "subject_id",
            "type" => "select",
            "operator" => "=",
            "icon" => Subject::META["icon"],
            "selectData" => [
                "optionsFromScope" => [
                    Subject::class,
                    "forConnection",
                ],
                "emptyOption" => "wszystkie",
            ],
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
