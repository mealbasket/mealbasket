@extends('layouts.app') 
@section('content')
<div class="container">
    <h2>Ticket ID: {{$ticket->id}} Status: {{$ticket->status ? 'Solved': 'Pending'}}</h2>
    <a class="btn btn-primary" data-toggle="collapse" href="#reply" role="button">Add reply</a>
    <form action="/home/support/{{$ticket->id}}" class="pt-4 collapse" id="reply" method="POST">
      @csrf
      {{ method_field('PUT') }}
      <div class="form-group row">
          <label for="message" class="col-md-4 col-form-label text-md-right">Message</label>
              <div class="col-md-6">
                  <input id="message" type="text" class="form-control" name="message" required>
              </div>
      </div>
      <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
      </div>
  </form>
  @if($ticket->status==0)
    <button class="btn btn-primary" onclick="event.preventDefault();document.getElementById('status-form').submit();">Mark Solved</button>
    <form id="status-form" action="/home/support/{{$ticket->id}}" method="POST" style="display: none;">
      @csrf
    </form>
  @endif
  @foreach($messages as $message)
    <p>msg:{{$message->message}}
      date:{{$message->created_at->diffForHumans()}}
      by:{{$message->User->name}}
    </p>
  @endforeach
</div>
@endsection