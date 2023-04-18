<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoSeoTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo__seo_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('seo_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->unique(['seo_id', 'locale']);
            $table->foreign('seo_id')->references('id')->on('seo__seos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seo__seo_translations', function (Blueprint $table) {
            $table->dropForeign(['seo_id']);
        });
        Schema::dropIfExists('seo__seo_translations');
    }
}
