<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateitemShopLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_shop_links', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');   //ID
            $table->string('title', 1000);   //タイトル
            $table->string('url', 2083);   //URL
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
        Schema::dropIfExists('item_shop_links');
    }
}
