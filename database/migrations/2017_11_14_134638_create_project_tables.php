<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category')->comment("品类");
            $table->string('city')->comment("城市");
            $table->string('name')->comment("项目名称/客户名称");
            $table->string('business')->comment("项目操作集成商/总包名称 ");
            $table->string('manager')->comment('负责人');
            $table->text('model')->comment('型号/数量');
            $table->text('camera')->comment('镜头/数量');
            //$table->string('num')->comment('镜头数量');
            $table->string('power')->comment('把握度');
            $table->string('delivery_time')->comment('预计交货日期');
            $table->text('remarks')->comment('项目备注')->nullable();
            $table->tinyInteger('report')->default(0)->comment('是否报备，0:未报备 1:报备');
            $table->string('report_time', 30)->comment("报备时间")->nullable();
            $table->tinyInteger('review_status')->nullable()->comment('报备审核状态，0:失败 1:成功');
            $table->string('review_time', 30)->comment("反馈时间")->nullable();
            $table->string('files')->comment("项目图片")->nullable();
            $table->string('belong_user_id')->comment("项目归属人");
            //$table->string('check_user_id')->comment("项目隶属审核人");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
