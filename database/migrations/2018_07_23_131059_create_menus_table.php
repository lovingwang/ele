<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string("goods_name")->comment("菜品名称");
            $table->integer("rating")->comment("菜品评分");
            $table->string("shop_id")->comment("所属商家id");
            $table->string("category_id")->comment("所属商家分类id");
            $table->string("goods_price")->comment("商品价格");
            $table->string("description")->comment("商品描述");
            $table->string("month_sales")->comment("月销量");
            $table->string("rating_count")->comment("评分数量");
            $table->string("tips")->comment("提示信息");
            $table->integer("satisfy_count")->comment("满意度数量");
            $table->float("satisfy_rate")->comment("满意度评分");
            $table->string("goods_img")->comment("图片");
            $table->integer("status")->comment("状态");

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
        Schema::dropIfExists('menus');
    }
}
