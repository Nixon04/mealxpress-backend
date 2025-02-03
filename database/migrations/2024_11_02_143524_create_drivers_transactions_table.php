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
        Schema::create('drivers_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('transfer_means');
            $table->string('transfer_method');
            $table->string('amount');
            $table->string('date');
            $table->string('status');
            $table->string('reference');
            $table->string('statement');
            $table->string('remark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers_transactions');
    }
};
