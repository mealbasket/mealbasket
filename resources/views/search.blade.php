@extends('layouts.app') 
@section('content')
<div class="row pt-4 justify-content-center">
    <div class="col-md-12">
    <h3>Search</h3>
    <form action="/search" method="POST">
      <div class="row px-3">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="query" placeholder="Enter search query">
          <div class="input-group-append">
            <div class="dropdown text-right">
              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Search
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button name="type" value="recipe" class="dropdown-item">Recipe Search</button>
                <button name="type" value="ingredient" class="dropdown-item">Ingredient Search</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    </div>
</div>
@endsection