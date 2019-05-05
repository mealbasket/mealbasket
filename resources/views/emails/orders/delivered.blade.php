@component('mail::message')
Dear {{$order->User->name}},

Your order #{{$order->id}} has been delivered successfully.

@include('emails.orders.address')

@include('emails.orders.items')

Incase the items are not delivered or missing please open a support ticket by clicking the button below.
@component('mail::button', ['url' => config('app.url').'/home/support'])
Open Support Ticket
@endcomponent

Thanks,<br>
Team {{ config('app.name') }}
@endcomponent
