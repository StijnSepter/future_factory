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
        Schema::create('waterstof aandrijving138', function (Blueprint $table){
            $table->increments('id')->length(11);
            $table->string("type");
            $table->timestamps();
            $table->string("power");
            $table->integer("time");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
