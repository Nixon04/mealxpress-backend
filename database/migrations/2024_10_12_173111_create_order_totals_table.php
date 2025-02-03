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
        Schema::create('order_totals', function (Blueprint $table) {
            $table->id();
            $table->string('market_id');
            $table->string('username');
            $table->string('delivery_amount');
            $table->string('service_fee');
            $table->string('sum_total');
            $table->string('total_amount');
            $table->string('status_point');
            $table->string('delivery_message');
            $table->string('delivery_address');
            $table->string('approvestat');
            $table->string('delivery_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_totals');
    }
};
