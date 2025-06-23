<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, check the structure of the events table
        $eventsTableInfo = DB::select("SHOW KEYS FROM events WHERE Key_name = 'PRIMARY'");
        
        // If there's an issue with the primary key, we'll recreate it
        if (empty($eventsTableInfo) || $eventsTableInfo[0]->Column_name !== 'id') {
            Schema::table('events', function (Blueprint $table) {
                // Drop existing primary key if any
                DB::statement('ALTER TABLE events DROP PRIMARY KEY');
                
                // Add proper id column as primary key
                $table->unsignedBigInteger('id', true)->first()->change();
            });
        }

        // Now create the event_admins table
        Schema::create('event_admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('event_id');
            $table->timestamps();
            
            // Add indexes
            $table->index('user_id');
            $table->index('event_id');
            
            // Add unique constraint
            $table->unique(['user_id', 'event_id']);
            
            // Add foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_admins');
    }
}; 