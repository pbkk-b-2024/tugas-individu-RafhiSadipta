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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user
            $table->foreignId('cart_id')->nullable()->constrained()->onDelete('cascade'); // Relasi ke keranjang (cart)
            $table->decimal('total_amount', 10, 2); // Jumlah total pembayaran
            $table->string('payment_method'); // Metode pembayaran (misal: 'credit card', 'bank transfer')
            $table->string('payment_status')->default('pending'); // Status pembayaran (misal: 'pending', 'completed')
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
