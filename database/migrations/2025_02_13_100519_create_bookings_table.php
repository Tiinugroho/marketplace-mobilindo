<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('code_transaction');
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade'); // Mobil yang dipesan
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User yang memesan
            $table->decimal('total_price', 15, 2)->nullable();
            $table->dateTime('date');
            $table->string('payment_proof')->nullable();
            $table->enum('booking_status', ['pending', 'completed', 'canceled'])->default('pending'); // Status booking
            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid'); // Status pembayaran
            $table->enum('type_payment', ['dp', 'lunas'])->nullable(); // Status pembayaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
