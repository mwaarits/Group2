<?php

use App\Http\Controllers\event_controller;
use App\Http\Controllers\order_controller;
use App\Http\Controllers\ticket_controller;
use App\Http\Controllers\user_controller;
use App\Http\Controllers\venue_controller;
use App\Http\Controllers\category_controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('userLogin');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/admin', function () {
    if (!Auth::check() || Auth::user()->role !== 'organizer') {
        abort(403, 'Forbidden');
    }
    return view('dashboard');
});

Route::get('/venue', function () {
    if (!Auth::check() || Auth::user()->role !== 'organizer') {
        abort(403, 'Forbidden');
    }
    return view('add_venue');
});

Route::get('/admin/login', function () {
    return view('login');
});

Route::get('/logout', [user_controller::class, 'logout']);

Route::get('/ticket', function () {
    if (!Auth::check() || Auth::user()->role !== 'organizer') {
        abort(403, 'Forbidden');
    }
    return app(ticket_controller::class)->index();
});

Route::get('/event', function () {
    if (!Auth::check() || Auth::user()->role !== 'organizer') {
        abort(403, 'Forbidden');
    }
    return app(event_controller::class)->event();
});



Route::get('/home', [event_controller::class, 'showEvent']);

Route::get('/detail/order', [order_controller::class, 'showOrder']);

Route::get('/list', function () {
    if (!Auth::check() || Auth::user()->role !== 'organizer') {
        abort(403, 'Forbidden');
    }
    return app(event_controller::class)->listEvent();
});

Route::get('/categories', function () {
    if (!Auth::check() || Auth::user()->role !== 'organizer') {
        abort(403, 'Forbidden');
    }
    return view('add_category');
});

Route::get('/update/event/{id}', [event_controller::class, 'update']);

Route::post('/user/regist', [user_controller::class, 'regist']);
Route::get('/user/regist', [user_controller::class, 'showRegisterForm']);

Route::get('/event/{id}', [event_controller::class, 'eventDetail']);

Route::post('/loginAdmin', [user_controller::class, 'adminLogin']);
Route::post('/add/venue', [venue_controller::class, 'addVenue']);
Route::post('/add/event', [event_controller::class, 'addEvent']);
Route::post('/add/ticket', [ticket_controller::class, 'addTicketType']);
Route::post('/add/category', [category_controller::class, 'addCategory']);
Route::post('/user/login', [user_controller::class, 'userLogin']);
Route::post('/order', [order_controller::class, 'addOrder']);
Route::get('/delete/event/{id}', [event_controller::class, 'delete']);




