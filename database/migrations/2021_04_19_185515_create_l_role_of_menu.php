<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLRoleOfMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_role_of_menu', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->default(0)->comment('角色id');
            $table->integer('menu_id')->default(0)->comment('权限id');
            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE l_role_of_menu COMMENT='角色权限表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('l_role_of_menu');
    }
}
