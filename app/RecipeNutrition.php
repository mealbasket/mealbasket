<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RecipeNutrition extends Pivot
{
    protected $table = 'recipe_nutrition';
    public $timestamps = true;

    public function Unit()
    {
        return $this->hasOne('App\Units', 'id', 'unit_id');
    }
}
