<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
    ];

    public function sale(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
