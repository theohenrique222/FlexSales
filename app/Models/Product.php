<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
    ];

    // public function sales()
    // {
    //     return $this->hasMany(Sale::class);
    // }

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, 'sale_product')
            ->withPivot('quantity');
    }
}
