<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('price'); //金額
            $table->date('date');
            $table->string('note')->nullable(); //備考
            $table->timestamps(); //登録更新日
            // $table->unsignedSmallInteger('rate'); //割合：貯蓄入金総額をどの口座(items->name)にどの割合で入金するか

            // 外部キー
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('editor_id');
            $table->unsignedBigInteger('transaction_item_id');

            // 外部キー制約
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('editor_id')->references('id')->on('users');
            // $table->foreign('transaction_item_id')->references('id')->on('transaction_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
