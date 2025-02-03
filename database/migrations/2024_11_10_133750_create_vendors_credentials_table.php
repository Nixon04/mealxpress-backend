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
        Schema::create('vendors_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('vendorsMarketId');
            $table->string('password');
            $table->string('contact');
            $table->string('email_address');
            $table->string('code');
            $table->string('last_updated');
            $table->string('info_check');
            $table->string('date_of_reg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors_credentials');
    }
};
