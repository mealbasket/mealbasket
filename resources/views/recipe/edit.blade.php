@extends('layouts.app') 
@section('content')
<div>
  <form action="{{url('/recipes/'.$recipe->id)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input type="text" name="name" value="{{$recipe->name}}">
    <img class="d-block w-100" src="{{ $recipe->getImageUrl() }}">
    <input type="text" name="rating" value="{{$recipe->rating}}">
    <input type="text" name="description" value="{{$recipe->description}}">
    <input type="text" name="prep_time" value="{{$recipe->prep_time}}">
    <input type="file" name="photo"/>
    <button type="submit" class="btn btn-primary">Edit</button>
  </form>
  <button class="btn btn-primary">Edit Nutrition</button>
  <button class="btn btn-primary">Edit Ingredients</button>
  <button class="btn btn-primary">Edit Steps</button>
</div>
@endsection