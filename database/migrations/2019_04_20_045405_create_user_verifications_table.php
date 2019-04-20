<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        New table for storing user verifications email data
        Schema::create('user_verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->unsigned();
            $table->string('token');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

//        new field in users table to check wether the user is verified or not
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_verified')->default(0)->after('plainpassword');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_verifications');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_verified');
        });
    }
}
