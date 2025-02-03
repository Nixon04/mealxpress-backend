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
        Schema::create('user_order_lists', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('marketid');
            $table->string('productname');
            $table->string('price');
            $table->string('portion');
            $table->string('total');
            $table->string('option');
            $table->string('cartimage');
            $table->string('cartweight');
            $table->string('cartreference');
            $table->string('cartdrink');
            $table->string('cartstatus');
            $table->string('cartrefcode');
            $table->string('cartpurchasedate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_order_lists');
    }
};
