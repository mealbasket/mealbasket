@extends('layouts.app') 
@section('content')
<h3>My Orders</h3>
<div class="row justify-content-center">
    <div class="col-md-10">
        @foreach($orders as $order)
        <div class="card">
            <div class="card-header">
                Order #{{$order->id}}
                <button class="btn btn-primary float-right mx-1" onclick="event.preventDefault();document.getElementById('delete-{{$order->id}}').submit();">Cancel</button>
                <button class="btn btn-success float-right mx-1" disabled>Payment Pending</button>
                <form id="delete-{{$order->id}}" action="/home/orders" method="POST" style="display: none;">
                    @csrf
                    {{method_field('DELETE')}}
                    <input type="hidden" name="id" value="{{$order->id}}">
                </form>
            </div>
            <div class="card-body">
                @foreach($order->Recipes as $r)
                    <p>{{$r->name}}</p>
                    <p>{{$r->pivot->price}}</p>
                    <p>{{$r->pivot->servings}}</p>
                    @foreach ($r->Ingredients as $ri)
                        @if($ri->pivot->value>0)
                            <p>{{$ri->name}} {{$ri->pivot->scaledQuantity($r->pivot->servings)}} {{$ri->pivot->Unit->unit_short}}</p>
                        @endif
                    @endforeach
                @endforeach
                @foreach($order->Ingredients as $i)
                    <p>{{$i->name}}</p>
                    <p>{{$i->pivot->price}}</p>
                    <p>{{$i->pivot->quantity}}</p>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection