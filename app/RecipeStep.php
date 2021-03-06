<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class RecipeStep extends Model
{
    public $incrementing = false;
    protected $fillable = ['id', 'text', 'image_path'];
    public function getImageUrl()
    {
        return Storage::disk('s3')->temporaryUrl($this->image_path, now()->addMinutes(5));
    }
}
