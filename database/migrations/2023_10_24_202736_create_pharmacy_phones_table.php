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
        Schema::create('pharmacy_phones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('phone')->unique();
            $table->foreignId('pharmacy_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('pharmacies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_phones');
    }
};
