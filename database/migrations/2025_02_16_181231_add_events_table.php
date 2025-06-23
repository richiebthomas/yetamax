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
        Schema::create('events', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('eventName');
            $table->text('eventDetails');
            $table->integer('entryFees');
            $table->string('eventCategory');
            $table->integer('eventDay');
            $table->string('startTime');
            $table->string('endTime');
            $table->integer('maxSeats');
            $table->integer('teamSize');
            $table->string('whatsapp');
            $table->boolean('isFeatured');
            $table->integer('dept');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
