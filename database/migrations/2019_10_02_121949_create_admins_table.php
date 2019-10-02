<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',60)->unique();
            $table->string('password',60);
            $table->string('email',60)->unique();
            $table->string('phone',20);
            $table->string('fullname',60);
            $table->tinyInteger('gender');
            $table->date('age');
            $table->text('address')->nullable();
            $table->string('avatar',200)->nullable();
            $table->tinyInteger('role')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
