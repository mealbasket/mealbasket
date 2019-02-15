<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Ingredient extends Model
{
    protected $appends = ['image'];
    public function getImageAttribute()
    {
        return Storage::disk('s3')->temporaryUrl('ingredient_images/'.$this->id.'.png', now()->addMinutes(5));
    }

    public function Unit()
    {
        return $this->hasOne('App\IngUnit', 'id', 'unit_id');
    }
}
