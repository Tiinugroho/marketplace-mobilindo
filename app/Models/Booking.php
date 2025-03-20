<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_transaction', 'produk_id', 'user_id', 'total_price', 'date', 'payment_proof', 'booking_status', 'payment_status','type_payment'
    ];

    // Relasi ke produk yang dipesan
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    // Relasi ke user sebagai pembeli
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke user sebagai seller
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

