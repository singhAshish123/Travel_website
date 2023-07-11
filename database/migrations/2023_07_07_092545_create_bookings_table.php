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
            $table->bigInteger('user_id');
            $table->bigInteger('hotel_id');
            $table->bigInteger('room_id');
            $table->string('check_in');
            $table->string('check_out');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('price');
            $table->string('guests');
            $table->string('status');
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
