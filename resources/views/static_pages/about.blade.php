@extends('layouts.app') 
@section('content')
<h1><i>About Us</i></h1>
<div class="row">
    <div class="col-md-6">
        <img src="{{ asset('/img/about.jpg') }}" style="max-width:100% !important; height:auto; display:block;" />
    </div>
    <div class="col-md-6">
        <div>
            <h2>Overview</h2>
            <p>
                In today’s fast moving world, people are busy and they find it difficult to buy fresh produce, to cook a meal. Also, help
                people with cooking who are new to it. Hence the main aim is to provide people fresh and guaranteed produce
                to cook a desired meal.
            </p>
            <p> With this project, we propose to bridge the gap between the desire to cook and the tedious job of identifying
                and acquiring produce.</p>
        </div>

        <div>
            <h2> Our Goal </h2>
            <p>The idea is to develop a web/mobile app wherein the user can go through a list of recipes, choose one suitable
                to his/her tastes, and then place an order for the ingredients required for that recipe.
            </p>
            <p>The site features a variety of tried and tested recipes from various cooking sites, along with a couple of our
                own.
            </p>
        </div>
    </div>
</div>
@endsection