<?php

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
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('slug');
            $table->text('body');
            $table->string('author');
            $table->timestamp('published_at');
            $table->boolean('active')->default(1);

            $table->integer('views')->defaults(0);
            $table->integer('facebook_shares')->defaults(0);
            $table->integer('twitter_shares')->defaults(0);
            $table->integer('google_plus_shares')->defaults(0);

            $table->integer('category_id')->nullable()->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

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
        Schema::drop('posts');
    }
}
