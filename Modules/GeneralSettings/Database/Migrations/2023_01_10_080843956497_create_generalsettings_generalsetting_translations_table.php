<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsGeneralSettingTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generalsettings__generalsetting_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('generalsetting_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['generalsetting_id', 'locale']);
            $table->foreign('generalsetting_id')->references('id')->on('generalsettings__generalsettings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generalsettings__generalsetting_translations', function (Blueprint $table) {
            $table->dropForeign(['generalsetting_id']);
        });
        Schema::dropIfExists('generalsettings__generalsetting_translations');
    }
}
