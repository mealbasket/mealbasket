<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderIngredient extends Pivot
{
    protected $table = 'order_ingredient';
}
