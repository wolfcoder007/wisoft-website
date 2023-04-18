<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockBlockTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block__block_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->integer('block_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('content');
            $table->string('author');
            $table->unique(['block_id', 'locale']);
            $table->foreign('block_id')->references('id')->on('block__blocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('block__block_translations', function (Blueprint $table) {
            $table->dropForeign(['block_id']);
        });
        Schema::dropIfExists('block__block_translations');
    }
}
