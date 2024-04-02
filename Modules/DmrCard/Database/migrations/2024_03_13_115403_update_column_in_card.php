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
        Schema::table('card', function (Blueprint $table) {
            $table->dropColumn('trail_name');
            $table->unsignedBigInteger('user_id')->reference('user_id')->on('user')->nullable(true)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('card', function (Blueprint $table) {
              $table->string('trail_name');
              $table->dropColumn('user_id');
        });
    }
};
