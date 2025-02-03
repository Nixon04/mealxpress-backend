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
        Schema::create('drink_lists', function (Blueprint $table) {
            $table->id();
            $table->string('drinkname');
            $table->string('drinkprice');
            $table->string('drinkquantity');
            $table->string('drinkimage');
            $table->string('option_status');
            $table->string('designated_schedule_future_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drink_lists');
    }
};
