<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
}
