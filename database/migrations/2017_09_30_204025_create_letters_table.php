<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('from_user_id')->comment('发信者');
            $table->unsignedInteger('to_user_id')->comment('收信者');
            $table->text('body')->comment('私信内容');
            $table->string('has_read',8)->default('F')->comment('私信是否已读');
            $table->timestamp('read_at')->nullable()->comment('私信读取时间');
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
        Schema::dropIfExists('letters');
    }
}
