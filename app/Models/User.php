<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Produk;
use App\Models\Booking;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'phone',
        'address',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi ke produk (mobil yang dijual)
    public function produks(): HasMany
    {
        return $this->hasMany(Produk::class, 'seller_id');
    }

    // Relasi ke booking sebagai pembeli
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    // Relasi ke booking sebagai penjual
    public function sales(): HasMany
    {
        return $this->hasMany(Booking::class, 'seller_id');
    }
}
