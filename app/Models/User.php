<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Model;

class User extends Model
{
    protected $table = 'users';
    public $timestamps = false;

    public function orders():HasMany
    {
        return $this->hasMany(Order::class);
    }
}
