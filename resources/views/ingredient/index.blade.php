@extends('layouts.app') 
@section('content')
<div>
  @if(count($ingredients)>0)
  <div class="row">
    @foreach($ingredients as $ingredient)
    <div class="col-6 col-md-2 py-2">
      <div class="card ingOrRecipeCard h-100">
        <img src="{{$ingredient->getImageUrl()}}" alt="{{$ingredient->name}}" style="height: 150px; width: auto;">
        <p class="card-title text-center font-weight-bold">{{$ingredient->name}}</p>
        <p class="card-title text-center font-weight-bold">{{$ingredient->base_quantity}} {{$ingredient->Unit->unit_short}}</p>
        <div class="card-body text-center py-2 d-flex flex-column">
          <p id="ingprice-{{ $ingredient->id }}" class="card-title font-weight-bold">₹{{$ingredient->price}}</p>
          <input id="ingip-{{ $ingredient->id }}" type="number" value="1" min="1" max="10" step="1" />
          <script>
            $("#ingip-{{ $ingredient->id }}").on("change", function (event) {
            value=parseInt({{$ingredient->price}}) * parseInt($('#ingip-{{ $ingredient->id }}').val());
            $('#ingprice-{{ $ingredient->id }}').text('₹' + value.toString());
            document.getElementById("addToCart-{{ $ingredient->id }}").elements["quantity"].value = parseInt($('#ingip-{{ $ingredient->id }}').val());
          })
          </script>
          <button type="button" class="mt-auto btn btn-warning" onclick="event.preventDefault();document.getElementById('addToCart-{{ $ingredient->id }}').submit();">Add To Cart</button>
          <form id="addToCart-{{ $ingredient->id }}" action="/cart" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="type" value="ingredient">
            <input type="hidden" name="id" value={{$ingredient->id}}>
            <!--TBD:Get actual quantity of ingredient here-->
            <input type="hidden" name="quantity" value="{{$ingredient->base_quantity}}">
          </form>
        </div>
      </div>
    </div>
    @endforeach {{$ingredients->links("pagination::bootstrap-4")}}
  </div>
  @else
  <p>No ingredients found</p>
  @endif
</div>
@endsection
 
@section('pagespecificscripts')
<script>
  var config = {
    decrementButton: "<strong>-</strong>",
    incrementButton: "<strong>+</strong>",
    groupClass: "input-group-sm pb-2 px-2 mt-auto",
    buttonsClass: "btn-outline-secondary",
    buttonsWidth: "1.5rem",
    textAlign: "center"
}
    $("input[type='number']").inputSpinner(config)

</script>
@endsection