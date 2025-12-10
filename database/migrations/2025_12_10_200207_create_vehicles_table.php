<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the final vehicle model (e.g., 'City Bus X2')
            $table->string('status')->default('pending'); // pending, in_assembly, completed
            
            // Foreign Keys linking to the 'modules' table
            $table->foreignId('chassis_module_id')->constrained('modules');
            $table->foreignId('drive_module_id')->constrained('modules');
            $table->foreignId('wheels_module_id')->constrained('modules');
            $table->foreignId('steering_module_id')->constrained('modules');
            $table->foreignId('seats_module_id')->nullable()->constrained('modules'); // Optional

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};