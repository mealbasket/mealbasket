<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'line1', 'line2', 'city', 'state', 'pincode', 'phone_number', 'default'
    ];
}
