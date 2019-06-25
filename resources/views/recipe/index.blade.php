@extends('layouts.app') 
@section('content')
<div>
  @if(count($recipes)>0)
  <div class="row">
    @foreach($recipes as $recipe)
    <div class="col-md-3 py-2">
      <div class="card ingOrRecipeCard h-100 w-100">
        <div class="card-block text-center pb-3">
          <img src="{{$recipe->getImageUrl()}}" alt="{{$recipe->name}}" style="height: 170px; width: auto;">
        </div>
        <p class="card-title font-weight-bold text-center">{{$recipe->name}}</p>
        <!--<p class="card-title font-weight-bold text-center">~ ₹$recipe->price/-</p>-->
        <div class="card-body text-center pb-2 d-flex flex-column">
          <button type="button" class="mt-auto btn btn-outline-success">
            <a style="color: #28a745;" href="{{ url( 'recipes/' . $recipe->id ) }}">View Details</a>
          </button>
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