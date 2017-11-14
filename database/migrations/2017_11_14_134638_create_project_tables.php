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
            $table->string('category');
            $table->string('city');
            $table->string('name');
            $table->string('business');
            $table->string('manager')->comment('负责人');
            $table->string('model')->comment('型号');
            $table->string('num')->comment('数量');
            $table->string('camera')->comment('镜头');
            $table->string('power')->comment('把握度');
            $table->string('delivery_time')->comment('预计交货日期');
            $table->string('remarks')->comment('项目备注');
            $table->tinyInteger('report')->default(0)->comment('是否报备，0:未报备 1:报备');
            $table->string('report_time', 30)->comment("报备时间");
            $table->tinyInteger('review_status')->nullable()->comment('报备审核状态，0:失败 1:成功');
            $table->string('review_time', 30)->comment("反馈时间");
            $table->string('files')->comment("项目图片");
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
