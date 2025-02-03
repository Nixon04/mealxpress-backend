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
        Schema::create('referral_packages', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('reg_user');
            $table->string('reg_amount');
            $table->string('reg_transact_total');
            $table->string('earning_per_referral');
            $table->string('reg_total');
            $table->string('reg_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_packages');
    }
};
