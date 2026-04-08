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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->foreignId('chassis_module_id')->constrained('modules');
            $table->foreignId('drive_module_id')->constrained('modules');
            $table->foreignId('wheels_module_id')->constrained('modules');
            $table->foreignId('steering_module_id')->constrained('modules');
            $table->foreignId('seats_module_id')->nullable()->constrained('modules');
            $table->string('status');
            $table->enum('robot', ['hydroboy', 'heavyD', 'twoWheels'])->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
