<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Address;
use App\OrderStatus;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.home');
    }

    public function changepw(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed'
        ]);
        $user = Auth::User();
        $user->password = Hash::make($request['password']);
        $user->save();
        return redirect('/home')->with('success', 'Password changed');
    }

    public function showAddress()
    {
        $addresses = Auth::User()->Addresses;
        return view('user.address')->with('addresses', $addresses);
    }

    public function addAddress(Request $request)
    {
        $this->validate($request, [
            'line1' => 'required|max:255|string',
            'line2' => 'nullable|max:255|string',
            'city' => 'required|max:255|string',
            'state' => 'required|max:255|string',
            'pincode' => 'required|numeric|digits:6',
            'phone_number' => 'required|numeric|digits:10',
        ]);
        $address = new Address;
        $address->line1 = $request['line1'];
        $address->line2 = $request['line2'];
        $address->city = $request['city'];
        $address->state = $request['state'];
        $address->pincode = $request['pincode'];
        $address->phone_number = $request['phone_number'];
        $address->user_id = Auth::User()->id;
        $address->save();
        return redirect('/home/address')->with('success', 'Address added');
    }

    public function deleteAddress(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric|exists:addresses,id'
        ]);
        $address = Address::find($request->id);
        if($address->default==1)
            return redirect('/home/address')->with('error', 'Cannot delete primary address');
        $address->delete();
        return redirect('/home/address')->with('success', 'Address deleted');
    }

    public function primaryAddress(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric|exists:addresses,id'
        ]);
        
        $address = Auth::User()->Addresses()->default();
        $address->default = 0;
        $address->save();

        $address = Address::find($request->id);
        $address->default = 1;
        $address->save();
        return redirect('/home/address')->with('success', 'Primary address updated');
    }

    public function showOrders()
    {
        $orders = Auth::User()->Orders;
        return view('user.orders')->with('orders', $orders);
    }

    public function cancelOrder(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric|exists:orders,id'
        ]);
        $order = Auth::User()->Orders()->find($request->id);
        if($order->Status->id >= OrderStatus::where('name', '=', 'dispatched')->first()->id)
            return redirect('/home/orders')->with('error', 'Order cannot be cancelled');
        $order->delete();
        return redirect('/home/orders')->with('success', 'Order cancelled');
    }
}
