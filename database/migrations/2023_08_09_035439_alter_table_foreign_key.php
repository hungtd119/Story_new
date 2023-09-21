<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('positions', function (Blueprint $table) {
            $table->foreign('interaction_id')->references('id')->on('interactions')->onDelete('cascade');
        });
        Schema::table('audios', function (Blueprint $table) {
            $table->foreign('text_id')->references('id')->on('texts')->onDelete('cascade');
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->foreign('story_id')->references('id')->on('stories')->onDelete('cascade');
        });
        Schema::table('interactions', function (Blueprint $table) {
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->foreign('text_id')->references('id')->on('texts')->onDelete('cascade');
        });
        Schema::table('text_config', function (Blueprint $table) {
            $table->foreign('text_id')->references('id')->on('texts')->onDelete('cascade');
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
    }
};
