<?php

namespace App\Models;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['seller_id','category_id', 'brand', 'model', 'year', 'price', 'description', 'status', 'image'];

    // Relasi ke seller (penjual)
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'category_id');
    }

    // Relasi ke booking
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
