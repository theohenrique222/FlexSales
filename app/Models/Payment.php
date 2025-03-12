<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'payment_method',
        'amount',
        'installment',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function installments()
    {
        return $this->hasMany(Installment::class);
    }
}
