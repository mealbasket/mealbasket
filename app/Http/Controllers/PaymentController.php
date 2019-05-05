<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Order;
use App\OrderStatus;
use Auth;
use Mail;
use App\Mail\MailOrderStatus;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function payment(Request $request)
    {
        $api = new Api(env('razor_key'), env('razor_secret'));
        try
        {
            $payment = $api->payment->fetch($request['razorpay_payment_id']);
            $response = $api->payment->fetch($request['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
        }
        catch(Exception $e)
        {
            return redirect('/cart')->with('error', $e->getMessage());
        }
        $cart = Auth::User()->Orders()->cart('=')->first();
        $status_id = OrderStatus::where('name', '=', 'payment success')->first()->id;
        $cart->status_id = $status_id;
        $cart->save();
        Mail::to(Auth::User()->email)->send(new MailOrderStatus($cart));
        return redirect('/home/orders')->with('status', 'Payment successful');
    }
}
