@extends('layouts.app') 
@section('content')
<div class="row">
    <h2>My Support Tickets</h2>
    <a class="btn btn-primary" href="/home/support/create" role="button">New ticket</a>
    @foreach ($tickets as $ticket)
        <a href="/home/support/{{$ticket->id}}">Ticket {{$ticket->id}}</a>
        <!--TODO: bold if ticket->unread==1-->
    @endforeach
</div>
@endsection