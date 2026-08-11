<?php

namespace App\Scaffolds;

use Wpwwhimself\Shipyard\Scaffolds\Modal as ShipyardModal;

class Modal extends ShipyardModal
{
    protected static function items(): array
    {
        return [
            "add-entry" => [
                "heading" => "Dodaj wpis",
                "target_route" => "clocks.add-entry",
                "fields" => [
                    model_field_modal_data("entries", "name"),
                ],
            ],
            "add-occurence" => [
                "heading" => "Dodaj wystąpienie",
                "target_route" => "clocks.add-occurence",
                "fields" => [
                    model_field_modal_data("occurences", "date"),
                ],
            ],
        ];
    }
}
