@extends('layouts.app') 
@section('content')
<div class="row justify-content-center py-4">
  <div class="col-md-8">
    <img style="width: inherit;" src="{{asset('/img/howItWorks.png')}}" />
  </div>
</div>
<h4>
  Some of our latest recipes...
</h4>
<!--TODO: Same for $recent, $random, $activity-->
@foreach ($activity as $a)
    {{$a->name}}
    {{$a->getImageUrl()}}
@endforeach
<div class="row pt-2">
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-2 col-sm-4">
        <div class="card">
          <a href="{{route('recipes.index')}}">
              <img class="card-img-top" src="https://images.media-allrecipes.com/userphotos/720x405/5638926.jpg" />
              <div class="card-block">
                <h5 class="card-title">
                  Chicken Tikka Masala
                </h5>
            </a>
          <p class="card-text">
            An Indian dish prepared with chicken in yogurt and spices and served in tomato sauce. Serve with rice or roti.
          </p>
          <p class="card-text">
            By Yakuta
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-4">
      <div class="card">
        <img class="card-img-top" src="https://images.media-allrecipes.com/userphotos/720x405/1031037.jpg" />
        <div class="card-block">
          <h5 class="card-title">
            Sweet Hot Mustard Chicken Thighs
          </h5>
          <p class="card-text">
            A few simple pantry ingredients combine to make a sweet-hot mustard marinade that…
          </p>
          <p class="card-text">
            By Chef John
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-4">
      <div class="card">
        <img class="card-img-top" src="https://images.media-allrecipes.com/userphotos/720x405/2254763.jpg" />
        <div class="card-block">
          <h5 class="card-title">
            Chicken Chimichangas with Sour Cream Sauce
          </h5>
          <p class="card-text">
            Green chiles and Monterey Jack cheese make these chimichangas special.
          </p>
          <p class="card-text">
            By SSTRAWDER
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-4">
      <div class="card">
        <img class="card-img-top" src="https://images.media-allrecipes.com/userphotos/720x405/3706561.jpg" />
        <div class="card-block">
          <h5 class="card-title">
            Slow Cooker Chicken Taco Soup
          </h5>
          <p class="card-text">
            A hearty combination of beans, corn, tomatoes, and taco seasonings, slow cooked with…
          </p>
          <p class="card-text">
            By RaisinKane aka Patti
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-4">
      <div class="card">
        <img class="card-img-top" src="https://images.media-allrecipes.com/userphotos/560x315/4340325.jpg" />
        <div class="card-block">
          <h5 class="card-title">
            Carne Asada Breakfast Fries
          </h5>
          <p class="card-text">
            Chunks of grilled carne asada, shredded cheese guacamole, cilantro, shredded cheese, and a fried egg wtih fries.
          </p>
          <p class="card-text">
            By bd.weld
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-4">
      <div class="card">
        <img class="card-img-top" src="https://images.media-allrecipes.com/userphotos/720x405/4572704.jpg" />
        <div class="card-block">
          <h5 class="card-title">
            Chicken Parmesan
          </h5>
          <p class="card-text">
            Mouth watering cheese oosing out of crispy deep fried chicken
          </p>
          <p class="card-text">
            By Chef John
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection