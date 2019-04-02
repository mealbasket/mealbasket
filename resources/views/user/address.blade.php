@extends('layouts.app') 
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">My Addresses
                <a class="btn btn-primary float-right" data-toggle="collapse" href="#addnew" role="button">Add new</a>
            </div>
            <div class="card-body">
                <form action="/home/address" class="pt-4 collapse" id="addnew" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="line1" class="col-md-4 col-form-label text-md-right">Address</label>

                        <div class="col-md-6">
                            <input id="line1" type="text" class="form-control{{ $errors->has('line1') ? ' is-invalid' : '' }}" name="line1" value="{{ old('line1') }}"
                                required autofocus> @if ($errors->has('line1'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('line1') }}</strong>
                                    </span> @endif

                            <input id="line2" type="text" class="mt-1 form-control{{ $errors->has('line2') ? ' is-invalid' : '' }}" name="line2" value="{{ old('line2') }}"
                                autofocus> @if ($errors->has('line2'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('line2') }}</strong>
                                    </span> @endif
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="city" class="col-md-4 col-form-label text-md-right">City</label>

                        <div class="col-md-6">
                            <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}"
                                required autofocus> @if ($errors->has('city'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span> @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="state" class="col-md-4 col-form-label text-md-right">State</label>

                        <div class="col-md-6">
                            <input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ old('state') }}"
                                required autofocus> @if ($errors->has('state'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span> @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pincode" class="col-md-4 col-form-label text-md-right">Pincode</label>

                        <div class="col-md-6">
                            <input id="pincode" type="text" class="form-control{{ $errors->has('pincode') ? ' is-invalid' : '' }}" name="pincode" value="{{ old('pincode') }}"
                                required autofocus> @if ($errors->has('pincode'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pincode') }}</strong>
                                    </span> @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone No.</label>

                        <div class="col-md-6">
                            <input id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}"
                                required autofocus> @if ($errors->has('phone_number'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span> @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                    </div>
                    <div class="dropdown-divider"></div>
                </form>
                <div class="row">
                    @foreach($addresses as $address)
                    <div class="card col-md-3 mx-2">
                        <div class="card-body">
                            @if($address->default==1)
                                <strong>Primary Address</strong>
                            @endif
                            <p>{{$address->line1}}</p>
                            <p>{{$address->line2}}</p>
                            <p>{{$address->city}}</p>
                            <p>{{$address->state}}</p>
                            <p>{{$address->pincode}}</p>
                            <p>+91-{{$address->phone_number}}</p>
                            @if($address->default==0)
                            <div class="row">
                                <a class="btn btn-info mx-1" onclick="event.preventDefault();document.getElementById('primary-address-{{$address->id}}').submit();">Primary</a>
                                <form id="primary-address-{{$address->id}}" action="/home/address" method="POST" style="display: none;">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <input type="hidden" name="id" value={{$address->id}}>
                                </form>

                                <a class="btn btn-warning mx-1" onclick="event.preventDefault();document.getElementById('delete-address-{{$address->id}}').submit();">Delete</a>
                                <form id="delete-address-{{$address->id}}" action="/home/address" method="POST" style="display: none;">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <input type="hidden" name="id" value={{$address->id}}>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection