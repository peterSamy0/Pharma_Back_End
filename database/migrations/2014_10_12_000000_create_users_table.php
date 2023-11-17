<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
<<<<<<< HEAD:database/migrations/2014_10_12_000000_create_users_table.php
=======
            $table->string('image')->nullable()->default(null);

>>>>>>> main:database/migrations/c-2014_10_12_000000_create_users_table.php
            $table->enum('role', ['admin', 'pharmacy', 'client', 'delivery'])->default('client');
            $table->string('image')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
