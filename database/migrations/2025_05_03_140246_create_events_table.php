<?php

use App\Models\User;
use App\Models\Venue;
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
            $table->id()->primary();
            $table->foreignIdFor(User::class)->onDelete('cascade');
            $table->foreignIdFor(Venue::class)->onDelete('cascade');
            $table->string('title');
            $table->string('description');
            $table->dateTime('startDateTime')->nullable(); // Format: YYYY-MM-DD HH:MM:SS
            $table->dateTime('endDateTime')->nullable(); 
            $table->string('image');
            // $table->timestamps();
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
