@extends('layouts.app') 
@section('content')
<h3>My Orders</h3>
<div class="pt-4 row justify-content-center">
    <div class="col-md-12">
        @foreach($orders as $order)
        <div class="card">
            <div class="card-header">
                Order #{{$order->id}}
                <button class="btn btn-primary float-right mx-1" onclick="event.preventDefault();document.getElementById('delete-{{$order->id}}').submit();">Cancel</button>
                <button class="btn btn-success float-right mx-1" disabled>Payment Pending</button>
                <form id="delete-{{$order->id}}" action="/home/orders" method="POST" style="display: none;">
                    @csrf {{method_field('DELETE')}}
                    <input type="hidden" name="id" value="{{$order->id}}">
                </form>
            </div>
            <div class="card-body">
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
                                    <div class="col-sm-3 hidden-xs"><img src="{{$i->getImageUrl()}}" alt="{{$i->name}}" style="height: auto; width: 120px;"
                                        /></div>
                                    <div class="col-sm-9">
                                        <h4 class="nomargin">{{$i->name}}</h4>
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
                                    <div class="col-sm-3 hidden-xs"><img src="{{$r->getImageUrl()}}" alt="{{$r->name}}" style="height: auto; width: 120px;"
                                        /></div>
                                    <div class="col-sm-9">
                                        <h4 class="nomargin">{{$r->name}}</h4>
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
                            <td colspan="2" class="hidden-xs"></td>
                            <td class="hidden-xs text-center"><strong>Total ₹{{$order->total}}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection