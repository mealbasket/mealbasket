<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class RecipeStep extends Model
{
    public $incrementing = false;
    protected $appends = ['image'];
    public function getImageAttribute()
    {
        $path = 'recipe_images/'.$this->recipe_id.'/steps/'.$this->id.'.png';
        return Storage::disk('s3')->temporaryUrl($path, now()->addMinutes(5));
    }
}
