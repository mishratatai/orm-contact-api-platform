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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('data_source');
            $table->enum('stage', ['New', 'Old'])->default('New');
            $table->enum('status', ['Active', 'Inactive', 'Old', 'Delete'])->default('Active');
            $table->string('name');
            $table->string('email');
            $table->string('phone_no')->nullable();
            $table->text('desc')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
