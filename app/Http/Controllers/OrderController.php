<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderStatus;
use App\Recipe;
use App\Ingredient;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cart()
    {
        $cart = Auth::User()->Orders()->cart()->first();
        return view('cart')->with('cart', $cart);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|in:recipe,ingredient',
            'id' => 'required|integer',
            'quantity' => 'required|integer'
        ]);
        $order = Auth::User()->Orders()->cart()->firstOrNew([]);
        $order->user_id = Auth::User()->id;
        $order->address_id = Auth::User()->Addresses()->default()->first()->id;
        $order->status_id = OrderStatus::where('name', '=', 'cart')->first()->id;
        $order->save();
        if($request->type=='recipe')
        {
            $recipe = Recipe::find($request->id);
            $price = $recipe->scaledPrice($request->quantity);
            $order->Recipes()->attach($recipe, ['servings' => $request->quantity, 'price'=> $price]);
        }
        else
        {
            $ingredient = Ingredient::find($request->id);
            $price = $ingredient->price * $request->quantity;
            $order->Ingredients()->attach($ingredient, ['quantity' => $request->quantity, 'price'=> $price]);
        }
        return redirect('/cart');
    }

}
