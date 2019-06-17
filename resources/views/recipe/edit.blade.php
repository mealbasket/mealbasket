@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-6 offset-md-3 text-center">
    <h5 class="my-3">Update Recipe</h5>
    <div class="mb-3">
      <form class="justify-content-center" action="{{url('/recipes/'.$recipe->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
          <label for="name">Recipe Name</label>
          <div class="offset-md-3 col-md-6">
            <input class="form-control" type="text" name="name" value="{{$recipe->name}}">
          </div>
        </div>
        <div class="form-group">
          <label for="rating">Rating</label>
          <div class="offset-md-3 col-md-6">
            <input class="form-control" type="text" name="rating" value="{{$recipe->rating}}">
          </div>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <div class="offset-md-3 col-md-6">
            <textarea class="form-control" type="text" name="description" col="50" rows="3">{{$recipe->description}}</textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="prep_time">Prep Time (mins)</label>
          <div class="offset-md-3 col-md-6">
            <input class="form-control" type="text" name="prep_time" value="{{$recipe->prep_time}}">
          </div>
        </div>
        <div class="form-group">
          <label for="photo">Choose Image</label>
          <div class="offset-md-3 col-md-6">
            <img class="py-2 my-2" src="{{ $recipe->getImageUrl() }}" style="height: 150px; width: auto;">
          </div>
          <div class="offset-md-3 col-md-6">
            <input class="form-control" type="file" name="photo"/>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
      @include('recipe.edit_nutrition')
      @include('recipe.edit_steps')
    </div>
    <button class="btn btn-primary">Edit Ingredients</button>
  </div>
</div>



@endsection
