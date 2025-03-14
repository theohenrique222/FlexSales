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
        'installments',
        'installment_values'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function getFormattedInstallmentValuesAttribute()
    {
        $values = json_decode($this->installment_values, true) ?? [];
        return implode(' R$ | ', $values);
    }
}
