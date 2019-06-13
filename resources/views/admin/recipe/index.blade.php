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
          <a class="mt-auto btn-block btn btn-warning" style="margin-bottom: 0.25rem!important;" href="#" role="button" onclick="approveRecipe('{{$recipe->id}}', 0)">Disapprove</a>          @else
          <a class="mt-auto btn-block btn btn-success" style="margin-bottom: 0.25rem!important;" href="#" role="button" onclick="approveRecipe('{{$recipe->id}}', 1)">Approve</a>          @endif
          <a class="btnAdmin btn-block btn btn-success" target="_blank" href="{{ url( 'recipes/' . $recipe->id ) }}" role="button">View</a>
          <a class="btnAdmin btn-block btn btn-info" href="#" role="button">Edit</a>
          <a class="btnAdmin btn-block btn btn-danger" href="#" onclick="deleteRecipe('{{$recipe->id}}')" role="button">Delete</a>
        </div>
      </div>
    </div>
    @endforeach {{$recipes->links("pagination::bootstrap-4")}}
  </div>
  <form id="approval-form" method="POST" style="display: none;">
    @method('PUT') @csrf
    <input type="hidden" id="approval-value" name="approved">
  </form>
  <form id="delete-form" method="POST" style="display: none;">
    @method('DELETE') @csrf
  </form>
  @else
  <p>No Recipes found</p>
  @endif
</div>
@endsection

@section('pagespecificscripts')
  <script>
    function approveRecipe(id, approve) {
      document.getElementById('approval-form').action = '{{url('recipes/')}}/' + id;
      document.getElementById('approval-value').value = approve;
      document.getElementById('approval-form').submit();
    }
    function deleteRecipe(id, approve) {
      document.getElementById('delete-form').action = '{{url('recipes/')}}/' + id;
      document.getElementById('delete-form').submit();
    }
  </script>
@endsection