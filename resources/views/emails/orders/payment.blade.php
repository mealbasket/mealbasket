@component('mail::message')
Dear {{$order->User->name}},

Payment for your order #{{$order->id}} has been received successfully.  
Your order is being processed and will be dispatched shortly.

@include('emails.orders.items')

Thanks,<br>
Team {{ config('app.name') }}
@endcomponent
