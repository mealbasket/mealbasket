<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeNutrition extends Model
{
    protected $table = 'recipe_nutrition';

    public function Unit()
    {
        return $this->hasOne('App\Units', 'id', 'unit_id');
    }
}
