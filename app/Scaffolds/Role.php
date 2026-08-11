<?php

namespace App\Scaffolds;

use Wpwwhimself\Shipyard\Scaffolds\Role as ShipyardRole;

class Role extends ShipyardRole
{
    protected static function items(): array
    {
        return [
            [
                "name" => "entry-manager",
                "icon" => "tag-edit",
                "description" => "Zarządza własnymi wpisami i ich tematami",
            ],
        ];
    }
}
