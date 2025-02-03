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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('marketproductid');       
            $table->string('marketproductweight');    
            $table->string('marketimage');
            $table->string('marketstoredimages');  
            $table->string('marketproductprice');       
            $table->string('marketproductname');       
            $table->string('marketproductrequired');       
            $table->string('marketproductoption');       
            $table->string('marketproducttotal_portion');       
            $table->string('marketproductorder_date');       
            $table->string('marketproductlink');       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
