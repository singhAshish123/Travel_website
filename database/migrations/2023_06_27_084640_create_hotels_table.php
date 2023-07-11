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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_name');
            $table->string('hotel_email');
            $table->string('address');
            $table->string('postal_code');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->string('hotel_help');
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->integer('total_room');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
