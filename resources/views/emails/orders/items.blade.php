@component('mail::table')
| Item           | Quantity      | Price         |
|:--------------:|:-------------:|:-------------:|
@foreach($order->Recipes as $r)
| {{$r->name}} | {{$r->pivot->servings}} | ₹{{$r->price}} |
@endforeach
@foreach($order->Ingredients as $i)
| {{$i->name}} | {{$i->pivot->quantity}} | ₹{{$i->price}} |
@endforeach
| Total | ₹{{$order->total}} |
@endcomponent
@component('mail::button', ['url' => config('app.url').'/home/orders', 'color' => 'success'])
View Order
@endcomponent