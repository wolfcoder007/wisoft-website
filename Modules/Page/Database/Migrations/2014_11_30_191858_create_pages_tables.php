<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page__pages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('is_home')->default(0);
            $table->string('template');
            $table->timestamps();
        });

        Schema::create('page__page_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->string('locale')->index();

            $table->string('title');
            $table->string('slug');
            $table->boolean('status')->default(1);
            $table->text('body');
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

            $table->unique(['page_id', 'locale']);
            $table->foreign('page_id')->references('id')->on('page__pages')->onDelete('cascade');
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
        Schema::drop('page__page_translations');
        Schema::drop('page__pages');
    }
}
