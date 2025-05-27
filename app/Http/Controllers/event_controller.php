<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\TicketTypes;
use App\Models\Venue;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;


class event_controller extends Controller
{
    public function event(){
        $venue = Venue::all(['id','name']);
        $categories = Category::all(['id','name']);
        return view('add_event', ['venues' => $venue, 'categories' => $categories]);
    }

    public function addEvent(Request $request){
        if(isset($request->id)){
            $event = Event::find($request->id);
        }else{
            $event = new Event();
        }
        $event -> title = $request->title;
        $event -> description = $request->description;
        $event -> startDateTime = $request->startDateTime;
        $event -> endDateTime = $request->endDateTime;
        $event -> user_id = Auth::id();
        $event -> venue_id = $request -> venue_id;
        $event->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $filename = time(). '.' . $photo->getClientOriginalExtension();
            $destinationPath = public_path('/photos');
            $photo->move($destinationPath, $filename);
            $event->image = $filename;
            }
        $event -> save();
        return redirect('/admin');
    }

    public function showEvent(Request $request) {
        $query = Event::with(['venue', 'category']);
    
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
    
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
    
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $query->whereHas('ticketTypes', function ($q) use ($request) {
                if ($request->filled('min_price')) {
                    $q->where('price', '>=', $request->min_price);
                }
                if ($request->filled('max_price')) {
                    $q->where('price', '<=', $request->max_price);
                }
            });
        }
    
        $events = $query->get();
        $categories = \App\Models\Category::all();
    
        return view('home', ["events" => $events, "categories" => $categories]);
    }

    public function eventDetail(string $id){
        $events = Event::with(['venue', 'category'])->find($id);
        $tickets = TicketTypes::where('event_id', $id)
            ->get(['id', 'name', 'price', 'quota']);
        return view('detail_event', ["events" => $events, "ticket" => $tickets]);
    }
    public function listEvent(){
        $events = Event::with(['user','venue'])->get();
        return view('list_event',["events" => $events]);
    }
    public function update(string $id){
        $event = Event::find($id);
        $venue = Venue::all(['id','name']);
        $categories= Category::all(['id','name']);

        return view('add_event',["event" => $event,"venues" => $venue, "categories" => $categories ]);
    }

    public function delete(string $id)
    {
        $event = Event::find($id);
        if ($event) {
            $event->delete();
            return redirect('/list')->with('success', 'Event berhasil dihapus');
        }
        return redirect('/list')->with('error', 'Event tidak ditemukan');
    }

    

    
}
