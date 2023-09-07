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
        Schema::create('positions', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->integer('position_x');
            $table->integer('position_y');
            $table->integer('width');
            $table->integer('height');
            $table->boolean('isDragging');
            $table->boolean('isResizing');
            $table->string('resizeDirect');
            $table->integer('dragStartX');
            $table->integer('dragStartY');
            $table->unsignedBigInteger('interaction_id');
            $table->unsignedBigInteger('text_id');
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
        Schema::dropIfExists('positions');
    }
};
