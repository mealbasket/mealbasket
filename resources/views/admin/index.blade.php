@extends('layouts.app') 
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Admin Dashboard</div>
            <div class="card-body">
                <a class="btn btn-primary" href="{{ url('admin/recipes')}}" role="button">Manage Recipes</a>
            </div>
        </div>
    </div>
</div>
@endsection