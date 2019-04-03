<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id'];

    public function Status()
    {
        return $this->belongsTo('App\OrderStatus', 'status_id', 'id');
    }

    public function scopeCart($query, $status)
    {
        return $query->whereHas('Status', function($q) use($status){
            $q->where('name', $status, 'cart');
        });
    }

    public function Ingredients()
    {
        return $this->belongsToMany('App\Ingredient', 'order_ingredient')->using('App\OrderIngredient')->withPivot(['quantity', 'price']);
    }

    public function Recipes()
    {
        return $this->belongsToMany('App\Recipe', 'order_recipe')->using('App\OrderRecipe')->withPivot(['servings', 'price']);
    }

    public function getTotalAttribute()
    {
        $total = 0;
        foreach($this->Ingredients as $i)
        {
            $total += $i->pivot->price;
        }
        foreach($this->Recipes as $r)
        {
            $total += $r->pivot->price;
        }
        return $total;
    }

    public function Address()
    {
        return $this->belongsTo('App\Address');
    }
}