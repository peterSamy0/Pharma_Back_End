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
        Schema::create('pharmacy_days_off', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pharmacy_id')->constrained()->onUpdate("cascade")->onDelete("cascade")->references('id')->on('pharmacies');
            $table->foreignId('day_id')->constrained()->onUpdate("cascade")->onDelete("cascade")->references('id')->on('days')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_days_off');
    }
};
