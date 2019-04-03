@extends('layouts.app') 
 
@section('content')
<h3>My Orders</h3>
@if($orders=="[]")
<p>No orders</p>
@else
<div class="pt-4 row justify-content-center">
    <div class="col-md-12">
        @foreach($orders as $order)
        <div class="card">
            <div class="card-header">
                Order #{{$order->id}}    User: {{$order->User->name}}<br/>
                Status: {{ucwords($order->Status->name)}}<br/>
                {{$order->Address->line1}}
                {{$order->Address->line2}}
                {{$order->Address->city}}
                {{$order->Address->state}}
                {{$order->Address->pincode}}
                {{$order->Address->phone_number}}
                <button class="btn btn-danger float-right mx-1" onclick="updateOrder('{{$order->id}}', 'delete')">Cancel Order</button>
                @if($order->Status->name=="payment success")
                <button class="btn btn-primary float-right mx-1" onclick="updateOrder('{{$order->id}}', 'dispatched')">Mark Dispatched</button>
                @endif
                @if($order->Status->name=="dispatched")
                <button class="btn btn-primary float-right mx-1" onclick="updateOrder('{{$order->id}}', 'delivered')">Mark Delivered</button>
                @endif
            </div>
            <div class="card-body">
                <div style="overflow-x: auto;">
                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width:50%">Product</th>
                                <th style="width:10%">Price</th>
                                <th style="width:8%">Quantity</th>
                                <th style="width:15%" class="text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--
                            <h3>Ingredients</h3> --}} @foreach($order->Ingredients as $i)
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-3 hidden-xs"><img class="cartOrderItemImg" src="{{$i->getImageUrl()}}" alt="{{$i->name}}" style="height: auto; width: 120px;"
                                            /></div>
                                        <div class="col-sm-9">
                                            <h4 class="nomargin cartOrderItemText">{{$i->name}}</h4>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price">₹{{$i->price}}</td>
                                <td data-th="Quantity" class="text-center">{{$i->pivot->quantity}}</td>
                                <td data-th="Subtotal" class="text-center">₹{{$i->pivot->price}}</td>
                            </tr>
                            @endforeach {{--
                            <h3>Recipes</h3> --}} @foreach($order->Recipes as $r)
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-3 hidden-xs"><img class="cartOrderItemImg" src="{{$r->getImageUrl()}}" alt="{{$r->name}}" style="height: auto; width: 120px;"
                                            /></div>
                                        <div class="col-sm-9">
                                            <h4 class="nomargin cartOrderItemText">{{$r->name}}</h4>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price">₹{{$r->price}}</td>
                                <td data-th="Quantity" class="text-center">{{$r->pivot->servings}}</td>
                                <td data-th="Subtotal" class="text-center">₹{{$r->pivot->price}}</td>
                            </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="3" class="hidden-xs"></td>
                                <td class="hidden-xs text-center"><strong>Total ₹{{$order->total}}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <form id="order-change-form" action="/admin/orders" method="POST" style="display: none;">
        @csrf
        {{method_field('PUT')}}
        <input id="order-change-id" type="hidden" name="id" value="">
        <input id="order-change-change" type="hidden" name="change" value="">
    </form>
</div>
@endif
@endsection

@section('pagespecificscripts')
    <script>
      function updateOrder(id, change) {
        document.getElementById('order-change-id').value = id;
        document.getElementById('order-change-change').value = change;
        document.getElementById('order-change-form').submit();
      }
    </script>
@endsection