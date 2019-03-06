@extends('layouts.app') 
@section('content')
<div>
  @if(count($recipes)>0)
  <div class="row">
    @foreach($recipes as $recipe)
    <div class="col-md-2 py-2">
      <div class="card ingOrRecipeCard">
        <div class="card-block text-center pb-3">
          @foreach ($recipe->Images as $image)
          <img src="{{$image}}" alt="{{$recipe->name}}" style="height: 150px; width: auto;">
          @endforeach
        </div>
        <p class="card-title font-weight-bold text-center">{{$recipe->name}}</p>
        <div class="row pb-2 justify-content-center">
          <button type="button" class="btn btn-outline-success" style="width: 50%">
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