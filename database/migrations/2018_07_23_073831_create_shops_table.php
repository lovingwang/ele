<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_category_id')->comment('商家分类id');
            $table->string('shop_name')->comment('商家名字');
            $table->string('shop_img')->comment('商家图片');
            $table->float('shop_rating')->comment('评分');
            $table->boolean('brand')->comment('是否名牌');
            $table->boolean('on_time')->comment('是否准时');
            $table->boolean('fengniao')->comment('是否是蜂鸟');
            $table->boolean('bao')->comment('是否保');
            $table->boolean('piao')->comment('是否票');
            $table->boolean('zhun')->comment('是否准时');
            $table->float('start_send')->comment('起送费');
            $table->float('send_cost')->comment('配送费');
            $table->string('notice')->comment('店公告');
            $table->string('discount')->comment('优惠信息');
            $table->integer('status')->commnet('1 表示正常 0 表示正在审核 -1 表示禁用');

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
        Schema::dropIfExists('shops');
    }
}
