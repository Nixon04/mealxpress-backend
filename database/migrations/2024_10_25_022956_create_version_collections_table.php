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
        Schema::create('version_collections', function (Blueprint $table) {
            $table->id();
            $table->string('versionName');
            $table->string('versionmessage');
            $table->string('versionsubmessage');
            $table->string('versionStatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('version_collections');
    }
};
