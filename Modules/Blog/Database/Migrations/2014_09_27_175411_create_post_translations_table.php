<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog__post_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('fb_title')->nullable();
            $table->string('fb_description')->nullable();
            $table->string('fb_type')->nullable();
            $table->string('fb_vedio_url')->nullable();
            $table->string('tw_title')->nullable();
            $table->string('tw_description')->nullable();
            $table->string('tw_card')->nullable();
            $table->string('cononical_url')->nullable();
            $table->unique(['post_id', 'locale']);
            $table->foreign('post_id')->references('id')->on('blog__posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blog__post_translations');
    }
}
