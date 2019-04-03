@extends('layouts.app') 
@section('content')
<div class="pt-4">
  <h2>Cart</h2>
  @if($cart==null)
    <p>No items in cart</p>
  @else
  <div style="overflow-x: auto;">
  <table id="cart" class="table table-hover table-condensed">
      <thead>
      <tr>
        <th style="width:50%">Product</th>
        <th style="width:10%">Price</th>
        <th style="width:8%">Quantity</th>
        <th style="width:15%" class="text-center">Subtotal</th>
        <th class="text-center" style="width:17%"><button class="btn btn-danger btn-sm" onclick="updateQuantity(0, 'cart', 0)"><i class="fa fa-trash-o"> Delete All</i></button>		</th>
      </tr>
    </thead>
    <tbody>
      {{-- <h3>Ingredients</h3> --}}
      @foreach($cart->Ingredients as $i)
      <tr>
        <td data-th="Product">
          <div class="row">
            <div class="col-sm-3 hidden-xs"><img class="cartOrderItemImg" src="{{$i->getImageUrl()}}" alt="{{$i->name}}" style="height: auto; width: 120px;"/></div>
            <div class="col-sm-9">
              <h4 class="nomargin cartOrderItemText">{{$i->name}}</h4>
            </div>
          </div>
        </td>
        <td data-th="Price">₹{{$i->price}}</td>
        <td data-th="Quantity">
          <input type="number" class="form-control text-center" value="{{$i->pivot->quantity}}" min="1" max="10" step="1" onchange="updateQuantity({{$i->id}}, 'ingredient', this.value)">
        </td>
        <td data-th="Subtotal" class="text-center">₹{{$i->pivot->price}}</td>
        <td class="actions text-center" data-th="">
            <!--<button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>-->
            <button class="btn btn-danger btn-sm" onclick="updateQuantity({{$i->id}}, 'ingredient', 0)"><i class="fa fa-trash-o"></i></button>								
        </td>
      </tr>
      @endforeach

      {{-- <h3>Recipes</h3> --}}
      @foreach($cart->Recipes as $r)
      <tr>
          <td data-th="Product">
            <div class="row">
              <div class="col-sm-3 hidden-xs"><img class="cartOrderItemImg" src="{{$r->getImageUrl()}}" alt="{{$r->name}}" style="height: auto; width: 120px;"/></div>
              <div class="col-sm-9">
                <h4 class="nomargin cartOrderItemText">{{$r->name}}</h4>
                {{-- <p>
                @foreach ($r->Ingredients as $ri)
                  @if($ri->pivot->value>0)
                    {{$ri->name}} {{$ri->pivot->scaledQuantity($r->pivot->servings)}} {{$ri->pivot->Unit->unit_short}}
                  @endif
                @endforeach
                </p> --}}
              </div>
            </div>
          </td>
          <td data-th="Price">₹{{$r->price}}</td>
          <td data-th="Quantity">
            <input type="number" class="form-control text-center" value="{{$r->pivot->servings}}" min="1" max="10" step="1" onchange="updateQuantity({{$r->id}}, 'recipe', this.value)">
          </td>
          <td data-th="Subtotal" class="text-center">₹{{$r->pivot->price}}</td>
          <td class="actions text-center" data-th="">
              <!--<button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>-->
              <button class="btn btn-danger btn-sm" onclick="updateQuantity({{$r->id}}, 'recipe', 0)"><i class="fa fa-trash-o"></i></button>
          </td>
      </tr>
      @endforeach
    </tbody>

    <tfoot>
      <tr>
        <td>
        <h4 style="display: inline;">Address:   </h4>
          <select id="address-select" style="width: 50%;" onchange="updateAddress()">
              <option value="{{$cart->Address->id}}" selected>{{$cart->Address->line1}}</option>
              @foreach ($addresses as $address)
                @if($address->id == $cart->Address->id)
                  @continue
                @endif
                <option value="{{$address->id}}">{{$address->line1}}</option>
              @endforeach
          </select>
        </td>
      </tr>
    
      <tr>
          <td><a href="/recipes" class="btn btn-warning">Continue Shopping</a></td>
          <td colspan="2" class="hidden-xs"></td>
          <td class="hidden-xs text-center"><strong>Total ₹{{$cart->total}}</strong></td>
          <td><a href="#" class="btn btn-success btn-block">Checkout</a></td>
        </tr>
      </tfoot>
    </table>
  </div>
    @endif

  <form id="address-change-form" action="/cart/address" method="POST" style="display: none;">
    @csrf
    {{method_field('PUT')}}
    <input id="address-change-id" type="hidden" name="id" value="">
  </form>

  <form id="qty-change-form" action="/cart/quantity" method="POST" style="display: none;">
    @csrf
    {{method_field('PUT')}}
    <input id="qty-change-id" type="hidden" name="id" value="">
    <input id="qty-change-type" type="hidden" name="type" value="">
    <input id="qty-change-val" type="hidden" name="quantity" value="">
  </form>

</div>
@endsection

@section('pagespecificscripts')
    <script>
      function updateAddress() {
        var q = document.getElementById("address-select");
        document.getElementById('address-change-id').value = q[q.selectedIndex].value;
        document.getElementById('address-change-form').submit();
      }
      function updateQuantity(item_id, item_type, item_qty) {
        document.getElementById('qty-change-id').value = item_id;
        document.getElementById('qty-change-type').value = item_type;
        document.getElementById('qty-change-val').value = item_qty;
        document.getElementById('qty-change-form').submit();
      }
    </script>
@endsection