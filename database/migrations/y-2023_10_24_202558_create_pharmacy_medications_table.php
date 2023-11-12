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
        Schema::create('pharmacy_medications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pharmacy_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('pharmacies');
            $table->foreignId('medication_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('medications');
            $table->bigInteger('price')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_medications');
    }
};
