<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLUserAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_user_admin', function (Blueprint $table) {
            $table->id();
            $table->string('name',128)->default('');
            $table->string('email',128)->unique()->default('');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile', 24)->default('');
            $table->string('password',128)->default('');
            $table->tinyInteger('status')->default(1)->comment('用户状态 1 启用 2 禁用');
            $table->tinyInteger('gender')->default(3)->comment('性别，1：男 2：女 3：未知');
            $table->string('avatar')->comment('头像图地址')->default('');
            $table->timestamps();
            $table->softDeletes();
        });
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE l_user_admin COMMENT='用户表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
