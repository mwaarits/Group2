<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TicketTypes;
use Illuminate\Http\Request;

class ticket_controller extends Controller
{
    public function addTicketType(Request $request){
        $ticket = new TicketTypes();
        $ticket->event_id = $request->event_id;
        $ticket->name = $request->name;
        $ticket->price = $request->price;
        $ticket->quota = $request->quota;
        $ticket->save();
        return redirect('/ticket')->with('success', 'Ticket berhasil ditambahkan');
    }
    public function index(){
        $events = Event::all(['id','title']);
        return view('add_ticket',['events'=>$events]);
    }
}
