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
                In today’s fast moving world, people are busy and they find it difficult to find the time to buy fresh produce to cook a meal. Also, some people are not aware of
                the wide range of ingredients available & the quantities that must be used.
            </p>
            <p>We have a wide variety of tried and tested recipes from around the globe, for you to choose from. Further you may choose the number of servings as you wish and 
            have just the right amount of produce delivered at your doorstep at a time of your choosing.</p>
        </div>
                
        <div>
            <h2> Our Goal </h2>
            <p>We aim to provide an individual who has the desire to cook with the knowledge and the produce inorder to help one realise their desire.
                We endure to provide the freshest of fresh ingredients, local, exotic and everything in between.
                We propose to bridge the gap between the desire to cook and the tedious job of identifying and acquiring produce.
            </p>
            <p>
            </p>
        </div>
    </div>
</div>
@endsection