<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plannings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('price'); //金額
            $table->date('date');
            $table->string('note')->nullable(); //備考
            $table->timestamps(); //登録更新日

            // 外部キー
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('editor_id');
            $table->unsignedBigInteger('planning_item_id');

            // 外部キー制約
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('editor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('planning_item_id')->references('id')->on('planning_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plannings');
    }
}
