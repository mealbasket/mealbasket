@extends('layouts.app') 
@section('content')
<div class="pt-4">
  <h3>Cart</h3>
  @if($cart==null)
    <p>No items in cart</p>
  @else
    @foreach($cart->Ingredients as $i)
      <p>{{$i->name}}</p>
      <p>{{$i->pivot->price}}</p>
      <p>{{$i->pivot->quantity}}</p><!--TBD: editable, when clicked away submit a post form, similar to addToCart-->
    @endforeach
    @foreach($cart->Recipes as $r)
      <p>{{$r->name}}</p>
      <p>{{$r->pivot->price}}</p>
      <p>{{$r->pivot->servings}}</p><!--TBD: editable, when clicked away submit a post form, similar to addToCart-->
      @foreach ($r->Ingredients as $ri)
        @if($ri->pivot->value>0)
          <p>{{$ri->name}} {{$ri->pivot->scaledQuantity($r->pivot->servings)}} {{$ri->pivot->Unit->unit_short}}</p>
        @endif
      @endforeach
    @endforeach
    <p>{{$cart->total}}</p>
  @endif
  <!--TBD: buttons for delete item, empty cart, checkout-->
</div>
@endsection