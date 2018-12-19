<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateitemCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');   //ID
            $table->bigInteger('item_id')->unsigned();  //item_id(外部キー制約の為親キーと同じくunsignedを付与。)
            $table->bigInteger('user_id');  //ユーザー名
            $table->string('comment', 3000);   //コメント
            $table->timestamps();   //登録日時(created_at)、更新日時(updated_at)
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade'); //item_id 外部キー参照
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_comments');
    }
}
