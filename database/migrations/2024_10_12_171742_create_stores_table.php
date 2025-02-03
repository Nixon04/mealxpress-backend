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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('marketstoreid');
            $table->string('marketstorename');
            $table->string('marketstorebio');
            $table->string('marketstorelinks');
            $table->string('marketstorebadge');
            $table->string('marketreg');
            $table->string('marketstoreaddress');
            $table->string('marketstatus');
            $table->string('marketsupportcourse');
            $table->string('marketstoreprofile');
            $table->string('marketstorecollection');
            $table->string('activehours');
            $table->string('session');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
