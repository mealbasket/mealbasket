<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderRecipe extends Pivot
{
    protected $table = 'order_recipe';
}
