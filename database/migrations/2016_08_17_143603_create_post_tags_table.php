<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('post_tags',function(Blueprint $table){
           $table->integer('post_id')->unsigned()->index();
           $table->integer('tag_id')->unsigned()->index();
            $table->timestamps();
        });

        //add foreign key voi cac bang khac

        Schema::table('post_tags', function(Blueprint $table){
           $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
           $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
    }
}
