<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    protected $fillable = ['unit_short'];

    public function getUnitShortAttribute($value)
    {
        if ($value=="undefined")
            return "";
        return $value;
    }
}
