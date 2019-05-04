@extends('layouts.app') 
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                <div class="card-body">
                    <p>Welcome back, {{Auth::User()->name}}</p>
                    <p>Email: {{Auth::User()->email}}</p>
                    <p>Customer since {{Auth::User()->created_at->format('jS F, Y')}}</p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#changepassword" role="button">Change Password</a>
                    <a class="btn btn-primary" href="/home/address" role="button">My Addresses</a>
                    <a class="btn btn-primary" href="/home/orders" role="button">My Orders</a>
                    <a class="btn btn-primary" href="/home/support" role="button">My Support tickets</a>
                    @if($unread>0)
                        <p>You have {{$unread}} unread support messages</p>
                    @endif
                    <form action="/home/changepw" class="pt-4 collapse" id="changepassword" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                        required>
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span> @endif
                                </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection