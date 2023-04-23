<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // 既存のcreated_byカラムを削除
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');

            // 新しいuser_idカラムを作成
            $table->unsignedBigInteger('user_id')->nullable(false);

            // user_idカラムに外部キー制約を追加
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // user_idカラムを削除
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // created_byカラムを再作成
            $table->unsignedBigInteger('created_by');

            // created_byカラムに外部キー制約を追加
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }
};