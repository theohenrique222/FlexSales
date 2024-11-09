<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $filable = [
        'sale_id',
        'payment_method',
        'amount',
        'installments',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
