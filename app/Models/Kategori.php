<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class);
    }
}
