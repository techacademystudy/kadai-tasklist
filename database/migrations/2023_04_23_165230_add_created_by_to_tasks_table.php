<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedByToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->after('id')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });
    }
}