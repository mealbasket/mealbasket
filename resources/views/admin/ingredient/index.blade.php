@extends('layouts.app') 
@section('content')
<div>
  @if(count($ingredients)>0)
  <p>Warning deleting a ingredient will also delete it from any associated recipes</p>
  <div class="row">
    @foreach($ingredients as $ing)
    <div class="col-6 col-md-2 py-2">
      <div class="card ingOrRecipeCard h-100" style="min-width: 160px!important;">
          <p class="card-title font-weight-bold text-center mt-3">{{$ing->name}}</p>
          <div class="card-body d-flex flex-column">
            <p>Price: {{$ing->price}}</p>
            <a class="btnAdmin btn-block btn btn-info" href="{{url('ingredients/'.$ing->id.'/edit')}}" role="button">Edit</a>
            <a class="btnAdmin btn-block btn btn-danger" href="#" onclick="deleteIngredient('{{$ing->id}}')" role="button">Delete</a>
          </div>
      </div>
    </div>
    @endforeach
  </div>
  <form id="delete-form" method="POST" style="display: none;">
      @method('DELETE') @csrf
  </form>
  @else
  <p>No Ingredients</p>
  @endif
</div>
@endsection

@section('pagespecificscripts')
  <script>
    function deleteIngredient(id) {
      document.getElementById('delete-form').action = '{{url('ingredients')}}/' + id;
      document.getElementById('delete-form').submit();
    }
  </script>
@endsection