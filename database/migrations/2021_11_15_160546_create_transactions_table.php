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
            $table->unsignedBigInteger('editor_id'); //登録者
            $table->unsignedBigInteger('price'); //金額
            $table->enum('TransactionItemType', 
                ['食材費', '外食費', '個別A', '個別B', '日用費', '交際費', '養育費', '贅沢費', '特別費']);
            $table->date('date'); //勘定科目の適用日
            // $table->unsignedSmallInteger('rate'); //割合：貯蓄入金総額をどの口座(items->name)にどの割合で入金するか
            $table->string('note'); //備考
            $table->timestamps(); //登録更新日

            // 外部キー
            $table->unsignedBigInteger('book_id');

            // 以下は無
            // $table->unique(['xxx_id', 'xxx_id']);
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
