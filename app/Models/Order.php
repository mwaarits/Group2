<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $table = 'orders';
    public $timestamps = false;

    public function event():BelongsTo
    {
        return $this->belongsTo(Event::class,'event_id');
    }
    public function ticket():BelongsTo
    {
        return $this->belongsTo(TicketTypes::class,'ticket_types_id');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
