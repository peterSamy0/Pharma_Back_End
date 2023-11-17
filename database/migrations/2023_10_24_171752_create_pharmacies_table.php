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
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('users');
            $table->string('licence_number')->unique();
            $table->bigInteger('bank_account')->unique();
            $table->foreignId('governorate_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('governorates');
            $table->foreignId('city_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('cities');
            $table->enum('admin_approval', ['pending', 'approved', 'rejected'])->defualt('pending');
            $table->string('street');
            $table->time('opening');
            $table->time('closing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacies');
    }
};
