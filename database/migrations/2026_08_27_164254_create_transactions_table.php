<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
         $table->id();
        $table->string('trx_id');
        $table->string('customer_name');
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->integer('quantity');
        $table->decimal('total_price', 15, 2);
        $table->enum('payment_method', ['Cash', 'QRIS', 'Transfer'])->default('Cash'); // <--- Kolom Baru
        $table->enum('status', ['Lunas', 'Pending', 'Batal'])->default('Pending');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};