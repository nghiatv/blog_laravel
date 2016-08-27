<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // tao bang categories


        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('banner_image');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });


        // Tao bang posts
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->longText('content');
            $table->boolean('status')->default(0);
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('banner_image')->nullable();
            $table->boolean('comment_enabled')->default(1);
            $table->integer('view');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
        });


        //tao bang tags

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        //Tao bang post_tag

        Schema::create('post_tags', function (Blueprint $table) {
            $table->integer('post_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('cascade')->onDelete('cascade');
            $table->primary('post_id', 'tag_id');

        });

        //Tao bang comments

        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('is_reply_to');
            $table->integer('user_id')->unsigned();
            $table->text('content');
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('posts');
        Schema::drop('tags');
        Schema::drop('post_tags');
        Schema::drop('comments');
        Schema::drop('categories');

    }
}
