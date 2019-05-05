@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row">
        <h2>My Support Tickets</h2>
        <a class="btn mx-2 px-2 py-2 btn-primary" data-toggle="collapse" href="#newticket" role="button">New Ticket</a>
    </div>
    {{-- Please edit form below --}}
    <form action="/home/support/create" class="pt-4 collapse" id="newticket" method="POST">
        @csrf {{ method_field('PUT') }}
        <div class="form-group">
            <div class="row">
                <label for="message" class="col-md-4 col-form-label text-md-right">Subject</label>
                <div class="col-md-6">
                    <input id="subject" type="text" class="form-control" name="subject" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="message" class="col-md-4 col-form-label text-md-right">Message</label>
                <div class="col-md-6">
                    <input id="message" type="text" class="form-control" name="message" required>
                </div>
            </div>
        </div>
        <div class="my-4 form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <div class="row mt-4">
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Ticket ID</th>
                    @auth @if(Auth::User()->hasRole('admin'))
                    <th>User</th>
                    @endif @endauth
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Creation Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket) @if ($ticket->read_status==0)
                <tr class="table-warning" style="font-weight: bold">
                    <td>{{$ticket->id}}</td>
                    @auth @if(Auth::User()->hasRole('admin'))
                    <td>{{$ticket->User->name}}</td>
                    @endif @endauth
                    <td>{{$ticket->subject}}</td>
                    <td>{{$ticket->status ? 'Solved': 'Pending - New Message'}}</td>
                    <td>{{$ticket->created_at->diffForHumans()}}</td>
                    <td>
                        <a class="btn btn-primary" href="/home/support/{{$ticket->id}}" role="button">View</a>
                    </td>
                </tr>
                @else
                <tr>
                    <td>{{$ticket->id}}</td>
                    @auth @if(Auth::User()->hasRole('admin'))
                    <td>{{$ticket->User->name}}</td>
                    @endif @endauth
                    <td>{{$ticket->subject}}</td>
                    <td>{{$ticket->status ? 'Solved': 'Pending - No New Messages'}}</td>
                    <td>{{$ticket->created_at->diffForHumans()}}</td>
                    <td>
                        <a class="btn btn-primary" href="/home/support/{{$ticket->id}}" role="button">View</a>
                    </td>
                </tr>
                @endif @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection