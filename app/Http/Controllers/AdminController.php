<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Order;
use App\OrderStatus;
use Auth;
use Mail;
use App\Mail\MailOrderStatus;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkRole:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the recipe index.
     *
     * @return \Illuminate\Http\Response
     */
    public function recipe()
    {
        $recipes = Recipe::select('id', 'name', 'approved')->paginate(30);
        return view('admin.recipe.index')->with('recipes', $recipes);
    }

    public function orders(Request $request)
    {
        if($request->has('all'))
            $orders = Order::cart('<>')->get()->sortByDesc('created_at');
        else
            $orders = Order::cart('<>')->whereBetween('status_id', [4, 6])->get()->sortByDesc('created_at');
        return view('admin.orders')->with('orders', $orders);
    }

    public function changeOrder(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric|exists:orders,id',
            'change' => 'required|string|in:delete,dispatched,delivered'
        ]);
        $order = Order::find($request->id);
        if($request->change=="delete")
        {    
            $order->delete();
        }
        else
        {
            $status_id = OrderStatus::where('name', '=', $request->change)->first()->id;
            $order->status_id = $status_id;
            $order->save();
            Mail::to(Auth::User()->email)->send(new MailOrderStatus($order));
        }
        return redirect('/admin/orders')->with('status', 'Order updated');
    }
}

