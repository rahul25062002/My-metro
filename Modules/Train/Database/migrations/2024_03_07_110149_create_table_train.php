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
        Schema::create('train', function (Blueprint $table) {
            $table->id('train_no');
            $table->string('station_from');
            $table->string('station_to');
            $table->string('start_time');
            $table->string('end_time');
        });

            
            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('train');
    }
};
