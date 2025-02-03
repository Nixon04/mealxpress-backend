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
        Schema::create('meal_lists', function (Blueprint $table) {
            $table->id();
            $table->string('Meatname');
            $table->string('Meatprice');
            $table->string('Meatquantity');
            $table->string('option_status');
            $table->string('designated_schedule_future_time');
            $table->string('MeatWeight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_lists');
    }
};
