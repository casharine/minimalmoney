<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('active_flag'); //アクティブbook選択
            $table->unsignedBigInteger('authorizer_id'); //承認者==作成者
            $table->timestamps();

            // 外部キー(unsignedBigInteger) -> null許容のカラム修飾子 -> テーブル名とカラム名を規約と外部キーにより決定
            $table->unsignedBigInteger('sharing_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
