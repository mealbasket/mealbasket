@extends('layouts.app') 
@section('content')
<div>
<div class="row" style="border-bottom-color: black;padding-top: 15px;border-bottom-width: unset; padding-bottom: 25px;border-bottom-style: double;">
<div class="col-md-offset-1 col-md-5">
    <div class="jumbotron">
      <p>
        <h2>{{$recipe->name}}</h2>
        <span id=stars><script>document.getElementById("stars").innerHTML = getStars({{$recipe->rating}});</script></span>
      </p>
      <p>{{$recipe->description}}</p>
      <h4>₹{{$recipe->price}}/-</h4>
      <p>
      <button type="button" class="btn btn-warning" onclick="event.preventDefault();document.getElementById('addToCart').submit();">Add To Cart</button>
      <form id="addToCart" action="/cart" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="type" value="recipe">
        <input type="hidden" name="id" value={{$recipe->id}}>
        <!--TBD:Get actual servings of recipe here-->
        <input type="hidden" name="quantity" value="{{$recipe->servings}}">
      </form>



      </p>
      <p style="font-size: 1.25rem;">
        <span class="recipeSpans far fa-clock"> {{$recipe->prep_time}}</span>

      <span class="recipeSpans fas fa-chart-pie">
        <input id="recipeServingsSpinner" type="number" value="{{$recipe->servings}}" min="1" max="10" step="1" onchange="updateServings();"/>
      </span>
        

        @foreach ($recipe->Nutrition as $nutr)
          @if( $nutr->name == "Calories" )
            <span class="recipeSpans fab fa-nutritionix"> {{ $nutr->pivot->value }} {{ $nutr->pivot->Unit->unit_short }}</span>
          @endif
        @endforeach
      </p>
    </div>
  </div>

  <div class="col-md-5 col-md-offset-1">
    <img class="d-block w-100" src="{{ $recipe->getImageUrl() }}">
  </div>
  </div>

  <div class="row pt-5">
    <div class="col-md-offset-1 col-md-10 col-md-offset-1">
      <h2>Ingredients</h2>
      <ul>
      @foreach ($recipe->Ingredients as $ing)
      <li class="list-item">
        <div class="form-check">
          {{-- <input type="checkbox" class="form-check-input" value=""> --}}
          <div class="row">
            <div class="col-md-4">{{ $ing->name }}</div>
            <div data-internalServings="{{$recipe->servings}}" data-internalQ="{{ $ing->pivot->value }}" class="col-md-3 ingredientItem">{{ $ing->pivot->value }} {{ $ing->pivot->Unit->unit_short}}</div>
          </div>
        </div>
      </li>
      @endforeach
    </div>
  </div>
<div class="row">
  <div class="col-md-offset-1 col-md-10 col-md-offset-1 py-4">
    <h2>Method</h2>
    @foreach ($recipe->Steps as $step)
    <h5>Step {{$step->id}}</h5>
    <img class="recipeImage py-2" src={{$step->getImageUrl()}}>
    <p>{{$step->text}}</p>
    @endforeach
  </div>
</div>

</div>
@endsection

@section('pagespecificscripts')
    <script>
      function updateServings() {
        var q = document.getElementById('recipeServingsSpinner').value;
        if(q < 1 || q > 10) {
          q = 1;
          document.getElementById('recipeServingsSpinner').value = 1;
        }
        var list = document.getElementsByClassName('ingredientItem');
        for(var i=0; i < list.length; i++) {
          var str = list[i].innerHTML;
          if(list[i].innerHTML != "to taste ") {
            str = parseInt(list[i].getAttribute('data-internalQ')) / parseInt(list[i].getAttribute('data-internalServings')) * q;
            var newValue = str.toString() + " " + list[i].innerHTML.substr(list[i].innerHTML.indexOf(' ')+1);
            document.getElementsByClassName('ingredientItem')[i].innerHTML = newValue;
            document.getElementById('addToCart').elements["quantity"].value=str;
          }
        }
      }
    </script>
@endsection