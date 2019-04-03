@extends('layouts.app') 
@section('content')
<div class="pt-4">
  <h2>Cart</h2>
  @if($cart==null)
    <p>No items in cart</p>
  @else
  <table id="cart" class="table table-hover table-condensed">
      <thead>
      <tr>
        <th style="width:50%">Product</th>
        <th style="width:10%">Price</th>
        <th style="width:8%">Quantity</th>
        <th style="width:15%" class="text-center">Subtotal</th>
        <th style="width:17%">Empty Cart <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>		</th>
      </tr>
    </thead>
    <tbody>
      {{-- <h3>Ingredients</h3> --}}
      @foreach($cart->Ingredients as $i)
      <tr>
        <td data-th="Product">
          <div class="row">
            <div class="col-sm-3 hidden-xs"><img src="{{$i->getImageUrl()}}" alt="{{$i->name}}" style="height: auto; width: 120px;"/></div>
            <div class="col-sm-9">
              <h4 class="nomargin">{{$i->name}}</h4>
            </div>
          </div>
        </td>
        <td data-th="Price">₹{{$i->price}}</td>
        <td data-th="Quantity">
          <input type="number" class="form-control text-center" value="{{$i->pivot->quantity}}" min="1" max="10" step="1"><!--TBD: editable, when clicked away submit a post form, similar to addToCart-->
        </td>
        <td data-th="Subtotal" class="text-center">₹{{$i->pivot->price}}</td>
        <td class="actions" data-th="">
            <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
            <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>								
        </td>
      </tr>
      @endforeach

      {{-- <h3>Recipes</h3> --}}
      @foreach($cart->Recipes as $r)
      <tr>
          <td data-th="Product">
            <div class="row">
              <div class="col-sm-3 hidden-xs"><img src="{{$r->getImageUrl()}}" alt="{{$r->name}}" style="height: auto; width: 120px;"/></div>
              <div class="col-sm-9">
                <h4 class="nomargin">{{$r->name}}</h4>
                <p>
                @foreach ($r->Ingredients as $ri)
                  @if($ri->pivot->value>0)
                    {{$ri->name}} {{$ri->pivot->scaledQuantity($r->pivot->servings)}} {{$ri->pivot->Unit->unit_short}}
                  @endif
                @endforeach
                </p>
              </div>
            </div>
          </td>
          <td data-th="Price">₹{{$r->price}}</td>
          <td data-th="Quantity">
            <input type="number" class="form-control text-center" value="{{$r->pivot->servings}}" min="1" max="10" step="1"><!--TBD: editable, when clicked away submit a post form, similar to addToCart-->
          </td>
          <td data-th="Subtotal" class="text-center">₹{{$r->pivot->price}}</td>
          <td class="actions" data-th="">
              <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
              <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>								
          </td>
      </tr>
      @endforeach
    </tbody>

    <tfoot>
      <tr>
        <td>
        <h4 style="display: inline;">Address:   </h4>
          <select style="width: 50%;">
              <option value="ad1">ad1</option>
              <option value="ad2">ad2</option>
              <option value="ad3">ad3</option>
              <option value="ad4">ad4</option>
          </select>
        </td>
      </tr>
    
      <tr>
          <td><a href="#" class="btn btn-warning">Continue Shopping</a></td>
          <td colspan="2" class="hidden-xs"></td>
          <td class="hidden-xs text-center"><strong>Total ₹{{$cart->total}}</strong></td>
          <td><a href="" class="btn btn-success btn-block">Checkout</a></td>
        </tr>
      </tfoot>
    </table>
    @endif

  <!--TBD: buttons for delete item, empty cart, checkout-->
</div>
@endsection