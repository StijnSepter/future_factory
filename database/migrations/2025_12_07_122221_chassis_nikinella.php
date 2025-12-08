<?php

use BcMath\Number;
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
        Schema::create('chassis nikinella', function (Blueprint $table){
            $table->increments('id')->length(11);
            $table->string("amount_of_wheels");
            $table->timestamps();
            $table->string("name");
            $table->decimal('price', 10, 2)->change();
            $table->json("type_voertuig");
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
