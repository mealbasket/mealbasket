@extends('layouts.app') 
@section('content')
<div>
  <form action="{{url('/ingredients/'.$ingredient->id)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input type="text" name="name" value="{{$ingredient->name}}">
    <img class="d-block w-100" src="{{ $ingredient->getImageUrl() }}">
    <input type="text" name="price" value="{{$ingredient->price}}">
    <input type="text" name="unit" value="{{$ingredient->Unit->unit_short}}">
    <input type="file" name="photo"/>
    <button type="submit" class="btn btn-primary">Edit</button>
  </form>
</div>
@endsection