<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustryIndustryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry__industry_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->integer('industry_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('content');
            $table->string('author');
            $table->unique(['industry_id', 'locale']);
            $table->foreign('industry_id')->references('id')->on('industry__industries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('industry__industry_translations', function (Blueprint $table) {
            $table->dropForeign(['industry_id']);
        });
        Schema::dropIfExists('industry__industry_translations');
    }
}
