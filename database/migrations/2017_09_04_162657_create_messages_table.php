<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //留言字段 ： id,user_id,title,content,
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsinged()->index()->comment('会员id');
            $table->integer('manager_id')->unsinged()->index()->comment('后台管理员id');
            $table->string('title')->comment('留言标题');
            $table->text('content')->comment('留言内容');
            $table->integer('type')->default(0)->comment('留言分类');
            $table->integer('status')->default(0)->comment('留言状态');
            $table->integer('likes_count')->default(0)->comment('点赞数');
            $table->integer('comments_count')->default(0)->comment('留言评论数');
            $table->string('is_disabled', 8)->default('F')->comment('是否逻辑删除');
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
        Schema::dropIfExists('messages');
    }
}
