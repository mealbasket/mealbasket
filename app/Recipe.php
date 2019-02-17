<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Recipe extends Model
{
    protected $appends = ['image'];
    public function getImageAttribute()
    {
        return Storage::disk('s3')->temporaryUrl('recipe_images/'.$this->id.'.png', now()->addMinutes(5));
    }
}
