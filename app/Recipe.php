<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Recipe extends Model
{
    protected $fillable = ['name', 'description', 'prep_time', 'servings', 'difficulty', 'rating', 'approved', 'site_id', 'image_path'];
    
    public function getPriceAttribute()
    {
        $price = 0;
        foreach($this->Ingredients as $ing)
        {
            if($ing->pivot->value>0)
                $price += $ing->pivot->scaledPrice(1);
        }
        return $price;
    }

    public function scaledPrice($servings)
    {
        $price = $this->price * $servings;
        return $price;
    }

    public function getImageUrl()
    {
        return Storage::disk('s3')->temporaryUrl($this->image_path, now()->addMinutes(5));
    }

    public function Nutrition()
    {
        return $this->belongsToMany('App\Nutrition', 'recipe_nutrition')->using('App\RecipeNutrition')->withPivot(['unit_id', 'value'])->withTimestamps();
    }

    public function Steps()
    {
        return $this->hasMany('App\RecipeStep', 'recipe_id', 'id');
    }

    public function Tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function Ingredients()
    {
        return $this->belongsToMany('App\Ingredient', 'recipe_ingredient')->using('App\RecipeIngredient')->withPivot(['unit_id', 'value'])->withTimestamps();
    }

    public function isApproved()
    {
        if($this->approved == '1')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', '=', '1');
    }

    public function Reviews()
    {
        return $this->hasMany('App\Review', 'recipe_id', 'id');
    }
}