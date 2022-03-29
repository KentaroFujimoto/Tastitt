<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->comment('ユーザID');
            $table->longtext('content', 127)->comment('内容');
            $table->boolean('level')->nullable(false)->comment('重要度');
            $table->string('date')->comment('期限日');
            $table->string('week')->comment('期限曜日');
            $table->string('time')->nullable()->comment('期限時間');
            $table->string('notify_time')->comment('通知時間');
            $table->string('notify_date_1')->nullable()->comment('通知日1');
            $table->string('notify_week_1')->nullable()->comment('通知曜日1');
            $table->string('notify_date_2')->nullable()->comment('通知日2');
            $table->string('notify_week_2')->nullable()->comment('通知曜日2');
            $table->string('notify_date_3')->nullable()->comment('通知日3');
            $table->string('notify_week_3')->nullable()->comment('通知曜日3');
            $table->datetime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日');
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('作成日');
            $table->datetime('deleted_at')->nullable()->comment('削除日');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
