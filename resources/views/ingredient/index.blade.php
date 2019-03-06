@extends('layouts.app') 
@section('content')
<div>
  @if(count($ingredients)>0)
  <div class="row">
    @foreach($ingredients as $ingredient)
    <div class="col-6 col-md-2 py-2">
      <div class="card ingOrRecipeCard">
        <div class="card-block text-center py-2">
          <img src="{{$ingredient->getImageUrl()}}" alt="{{$ingredient->name}}" style="height: 150px; width: auto;">
          <p class="card-title font-weight-bold">{{$ingredient->name}}</p>
          <p class="card-title font-weight-bold">{{$ingredient->base_quantity}} {{$ingredient->Unit->unit_short}}</p>
          <p id="ingprice-{{ $ingredient->id }}" class="card-title font-weight-bold">₹{{$ingredient->price}}</p>
          <input id="ingip-{{ $ingredient->id }}" type="number" value="1" min="1" max="10" step="1"/>
          <script>
          $("#ingip-{{ $ingredient->id }}").on("change", function (event) {
            value=parseInt({{$ingredient->price}}) * parseInt($('#ingip-{{ $ingredient->id }}').val());
            $('#ingprice-{{ $ingredient->id }}').text('₹' + value.toString());
          })
          </script>
          <button type="button" class="btn btn-warning">Add To Cart</button>
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
    groupClass: "input-group-sm pb-2 px-2",
    buttonsClass: "btn-outline-secondary",
    buttonsWidth: "1.5rem",
    textAlign: "center"
}
    $("input[type='number']").inputSpinner(config)
</script>
@endsection