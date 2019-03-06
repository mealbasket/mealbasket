<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RecipeIngredient extends Pivot
{
    protected $table = 'recipe_nutrition';
    public $timestamps = true;

    public function Unit()
    {
        return $this->hasOne('App\Units', 'id', 'unit_id');
    }

    public function getValueAttribute($value)
    {
        if($value==0)
            $value="to taste";
        return $value;
    }
}
