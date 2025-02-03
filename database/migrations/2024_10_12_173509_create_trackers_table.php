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
        Schema::create('trackers', function (Blueprint $table) {
            $table->id();
            $table->string('marketid');
            $table->string('tracker_id');
            $table->string('tracker_current_status_holder');
            $table->string('tracker_history');
            $table->string('tracker_code');
            $table->string('tracker_courier_name');
            $table->string('tracker_courier_contact');
            $table->string('tracker_courier_image');
            $table->string('tracker_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackers');
    }
};
