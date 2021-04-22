<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLUserAdminOfRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_user_admin_of_role', function (Blueprint $table) {
            $table->id();
            $table->integer('user_admin_id')->default(0)->comment('用户id');
            $table->integer('role_id')->default(0)->comment('角色id');
            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE l_user_admin_of_role COMMENT='权限表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l_user_admin_of_role');
    }
}
