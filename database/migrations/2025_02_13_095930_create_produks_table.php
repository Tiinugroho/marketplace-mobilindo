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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade'); // Relasi ke users
            $table->foreignId('category_id')->constrained('kategoris')->onDelete('cascade'); // Relasi ke users
            $table->string('brand');
            $table->string('model');
            $table->integer('year');
            $table->decimal('price', 15, 2);
            $table->text('description')->nullable();
            $table->string('status')->default('available'); // available, reserved, sold
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
