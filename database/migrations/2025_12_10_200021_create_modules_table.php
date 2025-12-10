<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            
            // Common Properties for ALL modules
            $table->string('name')->unique();
            $table->string('type'); // chassis, drive, wheels, etc.
            $table->integer('assembly_time_blocks'); // In blocks of 2 uur
            $table->decimal('cost', 10, 2);
            $table->string('image_path')->nullable();

            // Specific Properties (Stored as JSON or individual columns if preferred)
            $table->json('properties')->nullable(); // Store unique data (e.g., wheel diameter, chassis dimensions)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};