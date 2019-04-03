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
        $cart = Auth::User()->Orders()->cart('=')->first();
        $addresses = Auth::User()->Addresses;
        return view('cart')->with('cart', $cart)->with('addresses', $addresses);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|in:recipe,ingredient',
            'id' => 'required|integer',
            'quantity' => 'required|integer'
        ]);
        $order = Auth::User()->Orders()->cart('=')->firstOrNew([]);
        $order->user_id = Auth::User()->id;
        $order->address_id = Auth::User()->Addresses()->default()->id;
        $order->status_id = OrderStatus::where('name', '=', 'cart')->first()->id;
        $order->save();
        if($request->type=='recipe')
        {
            $r = $order->Recipes()->find($request->id);
            if($r!=""){
                $request->quantity += $r->pivot->servings;
                $this->changeQuantity($request);
            }
            else{
                $recipe = Recipe::find($request->id);
                $price = $recipe->scaledPrice($request->quantity);
                $order->Recipes()->attach($recipe, ['servings' => $request->quantity, 'price'=> $price]);
            }
        }
        else
        {
            $i = $order->Ingredients()->find($request->id);
            if($i!=""){
                $request->quantity += $i->pivot->quantity;
                $this->changeQuantity($request);
            }
            else{
                $ingredient = Ingredient::find($request->id);
                $price = $ingredient->price * $request->quantity;
                $order->Ingredients()->attach($ingredient, ['quantity' => $request->quantity, 'price'=> $price]);
            }
        }
        return redirect('/cart');
    }

    public function changeAddress(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:addresses,id'
        ]);
        $cart = Auth::User()->Orders()->cart('=')->first();
        if(Auth::User()->Addresses()->find($request->id) == "")
            return redirect('/cart')->with('error', 'Invalid address chosen');
        $cart->address_id = $request->id;
        $cart->save();
        return redirect('/cart')->with('success', 'Address changed');
    }

    public function changeQuantity(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|in:recipe,ingredient,cart',
            'id' => 'required|integer',
            'quantity' => 'required|integer'
        ]);
        $cart = Auth::User()->Orders()->cart('=')->first();
        if($request->type=="ingredient")
        {
            $i = $cart->Ingredients()->find($request->id);
            if($i=="")
                return redirect('/cart')->with('error', 'Invalid ingredient');
            if($request->quantity==0)
            {
                $i->pivot->delete();
            }
            else
            {
                $i->pivot->quantity = $request->quantity;
                $i->pivot->price = $i->price * $request->quantity;
                $i->pivot->save();
            }
        }
        if($request->type=="recipe")
        {
            $r = $cart->Recipes()->find($request->id);
            if($r=="")
                return redirect('/cart')->with('error', 'Invalid recipe');
            if($request->quantity==0)
            {
                $r->pivot->delete();
            }
            else
            {
                $r->pivot->servings = $request->quantity;
                $r->pivot->price = $r->scaledPrice($request->quantity);
                $r->pivot->save();
            }
        }
        if($request->type=="cart" || ($cart->Recipes()->count()==0 && $cart->Ingredients()->count()==0))
        {
            $cart->delete();
            return redirect('/cart')->with('success', 'Cart emptied');
        }
        return redirect('/cart')->with('success', 'Quantity changed');
    }

}
