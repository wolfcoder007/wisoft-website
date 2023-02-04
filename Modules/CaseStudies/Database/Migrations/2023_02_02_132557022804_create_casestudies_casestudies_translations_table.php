<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseStudiesCaseStudiesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casestudies__casestudies_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->integer('case_studies_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('content');
            $table->string('author');
            $table->unique(['case_studies_id', 'locale']);
            $table->foreign('case_studies_id')->references('id')->on('casestudies__casestudies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('casestudies__casestudies_translations', function (Blueprint $table) {
            $table->dropForeign(['case_studies_id']);
        });
        Schema::dropIfExists('casestudies__casestudies_translations');
    }
}
