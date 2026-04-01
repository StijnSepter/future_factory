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
            $table->json('properties')->nullable(); 
            $table->integer('assembly_time_blocks');
            $table->decimal('cost', 10, 2);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};