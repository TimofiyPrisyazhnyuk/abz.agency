<?php

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
            $table->increments('id');
            $table->string('surname',21);
            $table->string('first_name',21);
            $table->string('patronymic',21);
            $table->string('email',50)->unique();
            $table->string('password',100);
            $table->string('image',50)->nullable();
            $table->date('date_engagement');
            $table->unsignedDecimal('amount_of_wages',8,2);
            $table->unsignedInteger('position_id');
            $table->rememberToken();
//            $table->timestamps();
        });
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
