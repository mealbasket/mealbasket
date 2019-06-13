<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Ingredient extends Model
{
    protected $fillable = ['name', 'price'];

    public function getImageUrl()
    {
        return Storage::disk('s3')->temporaryUrl($this->image_path, now()->addMinutes(5));
    }

    public function Unit()
    {
        return $this->hasOne('App\Units', 'id', 'unit_id');
    }
}
