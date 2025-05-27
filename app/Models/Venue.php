<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venue extends Model
{
    protected $table = "venues";
    public $timestamps = false;

    public function events():HasMany
    {
        return $this->hasMany(Event::class);
    }
}
