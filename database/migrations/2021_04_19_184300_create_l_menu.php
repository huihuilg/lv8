<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_menu', function (Blueprint $table) {
            //
            $table->id();
            $table->string('name', 128)->default('')->comment('菜单名');
            $table->string('url', 64)->comment('地址')->default("");
            $table->string('api_url', 64)->comment('接口地址')->default("");
            $table->tinyInteger('type')->comment('类型，1展开菜单，3点击菜单，5功能点')->default(1);
            $table->tinyInteger('is_open')->comment('是否开放（不做限制），1开放，2不开启')->default(1);
            $table->unsignedInteger('sort')->comment('排序，数字越大排序越靠前')->default(0);
            $table->tinyInteger('status')->comment('状态，1正常，2禁用')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE l_menu COMMENT='权限表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('l_menu', function (Blueprint $table) {
            //
        });
    }
}
