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
      <h4>₹<span data-orgPrice="{{$recipe->price}}" id="recipe-price">{{$recipe->price}}</span>/-</h4>
      <p>
      <button type="button" class="btn btn-warning" onclick="event.preventDefault();document.getElementById('addToCart').submit();">Add To Cart</button>
      <form id="addToCart" action="/cart" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="type" value="recipe">
        <input type="hidden" name="id" value={{$recipe->id}}>
        <input type="hidden" name="quantity" value="1">
      </form>



      </p>
      <p style="font-size: 1.25rem;">
        <span class="recipeSpans far fa-clock"> {{$recipe->prep_time}}</span>

      <span class="recipeSpans fas fa-chart-pie">
        <input id="recipeServingsSpinner" type="number" value="1" min="1" max="10" step="1" onclick="updateServings();"/>
      </span>
        

        @foreach ($recipe->Nutrition as $nutr)
          @if( $nutr->name == "Calories" )
            <span class="recipeSpans fab fa-nutritionix"> {{ $nutr->pivot->value }} {{ $nutr->pivot->Unit->unit_short }}</span>
          @endif
        @endforeach
      </p>
      <h5><a id="readReviews" href="#reviews">Read Reviews</a></h5>
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
            @if($ing->pivot->value>0)
            <div data-internalServings="{{$recipe->servings}}" data-internalQ="{{ $ing->pivot->value }}" class="col-md-3 ingredientItem">{{ $ing->pivot->scaledQuantity(1) }} {{ $ing->pivot->Unit->unit_short}}</div>
            @else
            <div class="col-md-3 ingredientItemNonScalable">{{ $ing->pivot->value }} {{ $ing->pivot->Unit->unit_short}}</div>
            @endif
          </div>
        </div>
      </li>
      @endforeach
    </div>
  </div>
  <div class="row" style="border-bottom-color: black;padding-top: 15px;border-bottom-width: unset;border-bottom-style: double;">
    <div class="col-md-offset-1 col-md-10 col-md-offset-1 py-4">
      <h2>Method</h2>
      @foreach ($recipe->Steps as $step)
      <h5>Step {{$step->id}}</h5>
      <img class="recipeImage py-2" src={{$step->getImageUrl()}}>
      <p>{{$step->text}}</p>
      @endforeach
    </div>
  </div>
  @include('recipe.reviews')
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
            str = Math.ceil(parseInt(list[i].getAttribute('data-internalQ')) / parseInt(list[i].getAttribute('data-internalServings')) * q);
            var newValue = str.toString() + " " + list[i].innerHTML.substr(list[i].innerHTML.indexOf(' ')+1);
            document.getElementsByClassName('ingredientItem')[i].innerHTML = newValue;
            document.getElementById('addToCart')['quantity'].value=q;
            var o = document.getElementById('recipe-price').getAttribute('data-orgprice');
            document.getElementById('recipe-price').textContent = o * q;
          }
        }
      }
    </script>
<script>
  $(document).ready(function(){
    $('#readReviews').on('click', function(e) {
      e.preventDefault()
      $('html, body').animate(
        {
          scrollTop: $('#reviews').offset().top,
        },
        800
        )
      });
    });
</script>
@endsection