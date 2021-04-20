<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_role', function (Blueprint $table) {
            //
            $table->id();
            $table->integer('belongs_id')->default(0)->comment('角色上级所属id');
            $table->string('name',64)->default('')->comment('角色名');
            $table->string('code',64)->default('')->comment('code');
            $table->string('remark')->default('')->comment('备注');
            $table->tinyInteger('status')->default(1)->comment('1启用 2 禁用');
            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE l_role COMMENT='角色表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('l_role', function (Blueprint $table) {
            //
        });
    }
}
