<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Recipe extends Model
{
    protected $appends = ['images'];
    public function getImagesAttribute()
    {
        $folder = 'recipe_images/'.$this->id.'/';
        $count = count(Storage::disk('s3')->files($folder));
        $images = array();
        for($i=1; $i<=$count; $i++)
        {
            $images[] = Storage::disk('s3')->temporaryUrl($folder.$i.'.jpg', now()->addMinutes(5));
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
