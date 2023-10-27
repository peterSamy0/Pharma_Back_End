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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('clients');
            $table->foreignId('pharmacy_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('pharmacies');
            $table->foreignId('delivery_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('deliveries')->nullable();
            $table->enum('status',['pending','accepted','withDelivery','delivered'])->default("pending");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
