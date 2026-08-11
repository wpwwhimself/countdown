<?php

namespace App\Models;

use Wpwwhimself\Shipyard\Models\User as ShipyardUser;

class User extends ShipyardUser
{
    public const FROM_SHIPYARD = true;

    #region relations
    public function subjects()
    {
        return $this->hasMany(Subject::class, "created_by");
    }
    #endregion
}
