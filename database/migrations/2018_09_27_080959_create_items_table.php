<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');   //ID
            $table->string('key', 20);   //KEY
            $table->string('name');    //商品名
            $table->text('description')->nullable();    //説明文
            $table->bigInteger('volume')->nullable();   //内容量
            $table->bigInteger('price')->nullable();    //価格
            $table->bigInteger('per_gram_carolie')->nullable(); //グラムあたり(カロリー)
            $table->bigInteger('calorie')->nullable();  //カロリー
            $table->bigInteger('per_gram_carb')->nullable();    //グラムあたり(炭水化物)
            $table->bigInteger('carb')->nullable(); //炭水化物
            $table->bigInteger('per_gram_protein')->nullable(); //グラムあたり(たんぱく質)
            $table->bigInteger('protein')->nullable();  //たんぱく質
            $table->bigInteger('per_gram_fat')->nullable(); //グラムあたり(脂肪)
            $table->bigInteger('fat')->nullable();  //脂肪
            $table->timestamps();   //登録日時(created_at)、更新日時(updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
