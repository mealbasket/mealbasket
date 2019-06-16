@extends('layouts.app')
@section('content')
<div class="row pt-4 justify-content-center">
  <div class="col-md-6">
    <h3>Search</h3>
    <form action="/search" method="POST">
      @csrf
      <div class="row px-3">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="query" placeholder="Enter search query">
        </div>
      </div>

  </div>
  <div class="col-md-4">
    <div class="row justify-content-center" style="padding-top: 40px;">
  <span>
      <button name="type" value="recipe" class="btn btn-primary">Recipe Search</button>
      <button name="type" value="ingredient" class="btn btn-info">Ingredient Search</button>
    </span>
  </div>
  </div>
</form>
</div>
@endsection
