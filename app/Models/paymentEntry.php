<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paymentEntry extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function MedioPago()
    {
        return $this->belongsTo(paymentMode::class, 'id_payment_modes');
    }
}
