@extends('layouts.app') 
@section('content')
<div>
  @if(count($ingredients)>0)
  <div class="row">
    @foreach($ingredients as $ingredient)
    <div class="col-md-2 py-2">
      <div class="card" style="width: fit-content;">
        <div class="card-block text-center py-2">
          <img src="{{$ingredient->Image}}" alt="{{$ingredient->name}}" style="height: 150px; width: auto;">
          <p class="card-title font-weight-bold">{{$ingredient->name}}</p>
          <p class="card-title font-weight-bold">{{$ingredient->base_quantity}} {{$ingredient->Unit->unit_full}}</p>
          <p class="card-title font-weight-bold">₹{{$ingredient->price}}</p>
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