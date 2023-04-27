<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRecurringActivitiesTable extends Migration
{
    public function up()
    {
        Schema::table('recurring_activities', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8392742')->references('id')->on('users');
            $table->unsignedBigInteger('task_id')->nullable();
            $table->foreign('task_id', 'task_fk_8392743')->references('id')->on('tasks');
        });
    }
}
