<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',200);
            $table->string('slug',255);
            $table->text('sapo');
            $table->bigInteger('categories_id')->unsigned();
            $table->dateTime('publish_date')->nullable();
            $table->string('avatar',200);
            $table->bigInteger('admins_id')->unsigned();
            $table->integer('count_view')->default(0);
            $table->integer('lang_id')->default(1);
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
        Schema::dropIfExists('posts');
    }
}
