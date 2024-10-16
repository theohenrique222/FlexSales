<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SaleProduct extends Model
{
    use HasFactory;

    protected $table = 'sale_product';

    protected $fillable = [
        'product_id',
        'sale_id',
        'quantity',
    ];

    public function sale(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
