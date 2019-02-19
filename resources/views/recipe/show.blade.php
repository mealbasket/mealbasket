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
        <a href=""><button class="btn btn-success" type="button">Buy Now</button></a>
        <a href=""><button class="btn btn-warning" type="button">Add to Cart</button></a>
      </p>
      <p style="font-size: 1.25rem;">
        <span class="recipeSpans far fa-clock"> {{$recipe->prep_time}}</span>
        <span class="recipeSpans fas fa-chart-pie"> {{$recipe->servings}}</span>
        @foreach ($recipe->Nutrition as $nutr)
          @if( $nutr->name == "Calories" )
            <span class="recipeSpans fab fa-nutritionix"> {{ $nutr->value }} {{ $nutr->Unit->unit_short }}</span>
          @endif
        @endforeach
      </p>
    </div>
  </div>

  <div class="col-md-5 col-md-offset-1">
    <div class="carousel slide" id="carousel-983258">
      <ol class="carousel-indicators">
        @foreach ($recipe->Images as $img)
        <li data-slide-to="{{ $loop->index }}" data-target="#carousel-983258" class="active"></li>
        @endforeach
      </ol>
      <div class="carousel-inner">
        @foreach ($recipe->Images as $img)
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
          <img class="d-block w-100" src="{{ $img }}">
        </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#carousel-983258" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel-983258" data-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  </div>

  <div class="row" style="padding-top: 25px;">
    <div class="col-md-offset-1 col-md-10 col-md-offset-1">
      <h2>Ingredients</h2>
      <ul>
      @foreach ($recipe->Ingredients as $ing)
      <li class="list-item">
        <div class="form-check">
          <label class="form-check-label">
              <input type="checkbox" class="form-check-input" value="">
            {{ $ing->name }}
          </label>
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
    <img class="recipeImage py-2" src={{$step->Image}}>
    <p>{{$step->text}}</p>
    @endforeach
  </div>
</div>

</div>
@endsection

@section('pagespecificscripts')
    
@stop