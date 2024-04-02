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
        if(!Schema::hasColumn('users','email')){
            Schema::table('users', function (Blueprint $table) {
                $table->string('email')->after('user_name');
            });

        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('users','email')){
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('email');
            
            });
        }

    }

};
