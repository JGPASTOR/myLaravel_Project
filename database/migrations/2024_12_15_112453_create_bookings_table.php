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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade'); // Foreign key to services table
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->string('client_name'); 
            $table->string('client_phone');
            $table->unsignedBigInteger('service_user_id');
            $table->string('service_user_name');
            $table->string('service_user_phone');
            $table->string('service_user_address');
            $table->string('service_user_title');
            $table->integer('service_user_price');
            $table->string('service_user_image');
            $table->string('status');

            $table->string('date');
            $table->string('time');
            $table->string('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
