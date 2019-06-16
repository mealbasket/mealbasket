@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-6 offset-md-3 text-center">
    <h5 class="my-3">Enter details to create a new Ingredient</h5>
    <div>
      <form class="justify-content-center" action="{{url('/ingredients')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="name">Ingredient Name</label>
          <div class="offset-md-3 col-md-6">
            <input class="form-control" type="text" name="name">
          </div>
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <div class="offset-md-3 col-md-6">
            <input class="form-control" type="text" name="price">
          </div>
        </div>
        <div class="form-group">
          <label for="unit">Unit</label>
          <div class="offset-md-3 col-md-6">
            <input class="form-control" type="text" name="unit">
          </div>
        </div>
        <div class="form-group">
          <label for="photo">Choose image</label>
          <div class="offset-md-3 col-md-6">
            <input class="form-control" type="file" name="photo"/>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
      </form>
    </div>
  </div>
</div>
@endsection
