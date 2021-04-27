<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLUserOfWeixin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_user_of_weixin', function (Blueprint $table) {
            $table->id();
            $table->string('open_id', 128)->default('')->comment('微信open_id');
            $table->string('union_id', 128)->default('')->comment('微信union_id');
            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE l_user_of_weixin COMMENT='用户微信表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l_user_of_weixin');
    }
}
