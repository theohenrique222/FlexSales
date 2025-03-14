<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'payments_id'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
