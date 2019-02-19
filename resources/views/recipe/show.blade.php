@extends('layouts.app') 
@section('content')
<div>
  @foreach ($recipe->Images as $img)
  <p>{{$img}}</p>
  @endforeach
  <p>{{$recipe->name}}</p>
  <p>{{$recipe->description}}</p>
  <p>{{$recipe->prep_times}}</p>
  <p>{{$recipe->servings}}</p>
  <p>{{$recipe->difficulty}}</p>
  <p>{{$recipe->rating}}</p>
  <p>{{$recipe->price}}</p>
  <p>{{$recipe->Category->name}}</p>
  @foreach ($recipe->Nutrition as $nutr)
  <p>{{$nutr->name}} {{$nutr->value}} {{$nutr->Unit->unit_short}}</p>
  @endforeach
  <p></p>
  @foreach ($recipe->Steps as $step)
  <p>Step No. {{$step->id}}</p>
  <p>{{$step->text}}</p>
  <p>{{$step->Image}}</p>
  @endforeach
  <p></p>
  @foreach ($recipe->Tags as $tag)
  <p>{{$tag->name}}</p>
  @endforeach
</div>
@endsection