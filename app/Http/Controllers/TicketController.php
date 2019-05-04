<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketMessage;
use Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkRole:admin')->only(['adminIndex']);
    }

    public function index()
    {
        $tickets = Auth::User()->Tickets->sortByDesc('created_at');
        return view('support.index')->with('tickets', $tickets);
    }

    public function adminIndex()
    {
        $tickets = Ticket::all()->sortByDesc('created_at');
        return view('support.index')->with('tickets', $tickets);
    }

    public function create()
    {
        $ticket = new Ticket;
        Auth::User()->Tickets()->save($ticket);
        return view('support.show')->with('ticket', $ticket)->with('messages', []);
    }

    public function show(int $id)
    {
        if(Auth::User()->hasRole('admin')){
            $ticket = Ticket::find($id);
        }
        else{
            $ticket = Auth::User()->Tickets()->find($id);
        }
        if ($ticket == null)
            return redirect('/home/support')->with('error', 'Invalid ticket ID');
        $messages = $ticket->Messages->sortByDesc('created_at');
        if(Auth::User()->hasRole('admin'))
        {
            $ticket->admin_read = 1;
        }
        else {
            $ticket->user_read = 1;   
        }
        $ticket->save();
        return view('support.show')->with('ticket', $ticket)->with('messages', $messages);
    }

    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'message' => 'required|string'
        ]);
        if(Auth::User()->hasRole('admin')){
            $ticket = Ticket::find($id);
        }
        else{
            $ticket = Auth::User()->Tickets()->find($id);
        }
        if ($ticket == null)
            return back()->with('error', 'Invalid ticket ID');
        $message = new TicketMessage;
        $message->message = $request->message;
        $message->user_id = Auth::User()->id;
        $ticket->Messages()->save($message);
        $ticket->status = 0;
        if(Auth::User()->hasRole('admin'))
        {
            $ticket->user_read = 0;
        }
        else {
            $ticket->admin_read = 0;   
        }
        $ticket->save();
        return back()->with('success', 'Ticket Updated');
    }

    public function markSolved(Request $request, int $id)
    {
        if(Auth::User()->hasRole('admin')){
            $ticket = Ticket::find($id);
        }
        else{
            $ticket = Auth::User()->Tickets()->find($id);
        }
        if ($ticket == null)
            return back()->with('error', 'Invalid ticket ID');
        $ticket->status = 1;
        $ticket->user_read = 1;
        $ticket->admin_read = 1;
        $ticket->save();
        return back()->with('success', 'Ticket Updated');
    }
    public function destroy(int $id)
    {
        //
    }
}
