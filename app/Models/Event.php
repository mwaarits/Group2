<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $table = "events";
    public $timestamps = false;

    public function venue() :BelongsTo
    {
        return $this->belongsTo(Venue::class,'venue_id','id');
    }
    public function tickettypes():HasMany
    {
        return $this->hasMany(TicketTypes::class, 'event_id');
    }
    
    public function orders():HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
    return $this->belongsTo(Category::class);
    }

}
