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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('users');
            $table->foreignId('governorate_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('governorates');
            $table->foreignId('city_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->references('id')->on('cities');
            $table->enum('admin_approval', ['pending', 'approved', 'rejected'])->defualt('pending');
            $table->bigInteger('national_ID')->unique();
            $table->boolean('available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
