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
        Schema::create('AddMedicationsByPharmacy', function (Blueprint $table) {
            $table->id();
            $table->string('medicineName')->unique();
            $table->bigInteger('price');
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('categories');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('users');
            $table->string('image')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
