<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\TicketTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class order_controller extends Controller
{
    public function addOrder(Request $request){
        // Validasi input
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_type' => 'required|exists:tickettypes,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        // Ambil data ticket
        $ticket = TicketTypes::find($request->ticket_type);
        
        // Cek kuota tiket tersedia
        if (!$ticket->hasAvailableQuota($request->quantity)) {
            return redirect()->back()->with('error', 'Tidak cukup kuota tiket tersedia. Kuota tersisa: ' . $ticket->getAvailableQuota());
        }
        
        // Buat order baru
        $orders = new Order();
        $orders->event_id = $request->event_id;
        $orders->ticket_types_id = $request->ticket_type;
        $orders->quantity = $request->quantity;
        $totalPrice = $ticket->price * $request->quantity;
        $orders->unitPrice = $totalPrice;
        $orders->user_id = Auth::id();
        $orders->save();

        return redirect('/detail/order')->with('success', 'Tiket berhasil dipesan!');
    }
    
    public function showOrder(){
        $user_id = Auth::id();
        $orders = Order::with(['event','user','ticket'])->where('user_id',$user_id)->get();
        return view('detail_order',['orders'=>$orders]);
    }
}