<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class venue_controller extends Controller
{
    public function addVenue(Request $request){
        $venue  = new Venue();
        $venue->name = $request->name;
        $venue->address = $request->location;
        $venue->capacity = $request->capacity;
        $venue->save();
        return redirect('/venue')->with('success', 'Venue berhasil ditambahkan!');
    }
}
