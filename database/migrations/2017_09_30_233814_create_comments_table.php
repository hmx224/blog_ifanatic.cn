<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->text('body')->comment('评论内容');
            $table->unsignedInteger('commentable_id')->comment('多态关联id');
            $table->string('commentable_type')->comment('多态关联的类型');
            $table->unsignedInteger('parent_id')->nullable()->comment('评论的父级id');
            $table->smallInteger('level')->default(1)->comment('评论内容所在的层级');
            $table->string('is_hidden',8)->default('F')->comment('评论是否隐藏');
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
        Schema::dropIfExists('comments');
    }
}
