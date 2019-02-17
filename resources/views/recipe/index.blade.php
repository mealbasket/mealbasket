@extends('layouts.app') 
@section('content')
<div>
  @if(count($recipes)>0)
  <div class="row">
    @foreach($recipes as $recipe)
    <div class="col-md-2 py-2">
      <div class="card">
        <div class="card-block text-center py-2">
          <img src="{{$recipe->Image}}" alt="{{$recipe->name}}" style="height: 150px; width: auto;">
          <p class="card-title font-weight-bold">{{$ingredient->name}}</p>
          <p class="card-title"><span class="glyphicon glyphicon-time"></span> {{$recipe->prep_time}}</p>
          <p class="card-title font-weight-bold">₹{{$ingredient->price}}</p>
          <button type="button" class="btn btn-success">Buy Now</button>
          <button type="button" class="btn btn-warning">Add To Cart</button>
        </div>
      </div>
    </div>
    @endforeach {{$recipes->links("pagination::bootstrap-4")}}
  </div>
  @else
  <p>No Recipes found</p>
  @endif
</div>
@endsection