@extends('layouts.app') 
@section('content')
<div>
  @if(count($recipes)>0)
  <div class="row">
    @foreach($recipes as $recipe)
    <div class="col-6 col-md-2 py-2">
      <div class="card ingOrRecipeCard h-100" style="min-width: 160px!important;">
        <p class="card-title font-weight-bold text-center mt-3">{{$recipe->name}}</p>
        <div class="card-body d-flex flex-column">
          @if($recipe->isApproved())
          <a class="mt-auto btn-block btn btn-warning" style="margin-bottom: 0.25rem!important;" href="#" role="button" onclick="document.getElementById('approval-form').submit();">Disapprove</a>          @else
          <a class="mt-auto btn-block btn btn-success" style="margin-bottom: 0.25rem!important;" href="#" role="button" onclick="document.getElementById('approval-form').submit();">Approve</a>          @endif
          <form id="approval-form" action="{{ url('recipes/'.$recipe->id) }}" method="POST" style="display: none;">
            @method('PUT') @csrf
            <input type="hidden" name="approved" value="{{$recipe->isApproved() ? '0' : '1'}}">
          </form>
          <a class="btnAdmin btn-block btn btn-success" target="_blank" href="{{ url( 'recipes/' . $recipe->id ) }}" role="button">View</a>
          <a class="btnAdmin btn-block btn btn-info" href="#" role="button">Edit</a>
          <a class="btnAdmin btn-block btn btn-danger" href="#" role="button">Delete</a>
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