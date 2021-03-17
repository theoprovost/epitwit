<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->date('dob');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        // This below is not supported in heroku free plan

        //DB::statement("SET GLOBAL log_bin_trust_function_creators = 1;");

        // DB::statement("
        //     CREATE TRIGGER date_check BEFORE INSERT ON users
        //     FOR EACH ROW
        //         BEGIN
        //             IF NEW.dob >= (DATE_SUB(NOW(), INTERVAL 13 YEAR)) THEN
        //             SIGNAL SQLSTATE '45000'
        //                 SET MESSAGE_TEXT = 'You must be older than 13 to register';
        //             END IF;
        //         END;
        // ");
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
