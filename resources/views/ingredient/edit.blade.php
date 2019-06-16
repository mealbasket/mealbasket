@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-6 offset-md-3 text-center">
    <h5 class="my-3">Update Ingredient</h5>
    <div>
      <form class="justify-content-center" action="{{url('/ingredients/'.$ingredient->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
          <label for="name">Ingredient Name</label>
          <div class="offset-md-3 col-md-6">
            <input class="form-control" type="text" name="name" value="{{$ingredient->name}}">
          </div>
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <div class="offset-md-3 col-md-6">
            <input class="form-control" type="text" name="price" value="{{$ingredient->price}}">
          </div>
        </div>
        <div class="form-group">
          <label for="unit">Unit</label>
          <div class="offset-md-3 col-md-6">
            <input class="form-control" type="text" name="unit" value="{{$ingredient->Unit->unit_short}}">
          </div>
        </div>
        <div class="form-group">
          <label for="photo">Choose Image</label>
          <div class="offset-md-3 col-md-6">
            <img src="{{ $ingredient->getImageUrl() }}" style="height: 150px; width: auto;">
          </div>
          <div class="offset-md-3 col-md-6">
            <input class="form-control" type="file" name="photo"/>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
</div>
@endsection
