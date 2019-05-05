@component('mail::message')
Dear {{$order->User->name}},

Your order #{{$order->id}} has been dispatched successfully.

@include('emails.orders.address')

@include('emails.orders.items')

Thanks,<br>
Team {{ config('app.name') }}
@endcomponent
