<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketTypes extends Model
{
    public $timestamps = false;
    protected $table = 'tickettypes';
    protected $fillable = ['name', 'price', 'quota', 'event_id'];

    public function event():BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function order():HasMany
    {
        return $this->hasMany(Order::class);
    }
    
    /**
     * Check if there's enough quota available for the requested quantity
     * 
     * @param int $requestedQuantity
     * @return bool
     */
    public function hasAvailableQuota(int $requestedQuantity): bool
    {
        // Get total tickets sold for this ticket type
        $soldTickets = $this->order()->sum('quantity');
        
        // Check if requested quantity exceeds available quota
        return ($soldTickets + $requestedQuantity) <= $this->quota;
    }
    
    /**
     * Get remaining available tickets
     * 
     * @return int
     */
    public function getAvailableQuota(): int
    {
        $soldTickets = $this->order()->sum('quantity');
        return max(0, $this->quota - $soldTickets);
    }
}