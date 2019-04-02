<?php

namespace App;

use App\Ingredient;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RecipeIngredient extends Pivot
{
    protected $table = 'recipe_ingredient';
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

    public function scaledPrice($servings)
    {
        $i_price = Ingredient::find($this->ingredient_id)->price;
        $price = $i_price * $this->scaledQuantity($servings);
        return $price;
    }

    public function scaledQuantity($servings)
    {
        $r = Recipe::find($this->recipe_id);
        $qty_reqd = ceil($this->value / $r->servings) * $servings;
        return $qty_reqd;
    }
}
