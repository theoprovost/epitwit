<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreUserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->after('username')->nullable();
            $table->string('telephone')->after('email')->nullable();
            $table->string('country')->after('telephone')->nullable();
            $table->string('city')->after('country')->nullable();
            $table->string('biography')->after('city')->nullable();
            $table->string('website')->after('biography')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
