@extends('layouts.app') 
@section('content')
<div>
  <form action="{{url('/ingredients')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name">
    <input type="text" name="price">
    <input type="text" name="unit">
    <input type="file" name="photo"/>
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
</div>
@endsection