<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Recipe extends Model
{
    protected $appends = ['images'];
    public function getImagesAttribute()
    {
        $paths = Storage::disk('s3')->files('recipe_images/'.$this->id);
        $images = array();
        foreach($paths as $path)
        {
            $images[] = Storage::disk('s3')->temporaryUrl($path, now()->addMinutes(5));
        }
        return $images;
    }

    public function Category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function Nutrition()
    {
        return $this->hasMany('App\RecipeNutrition', 'recipe_id', 'id');
    }
}
