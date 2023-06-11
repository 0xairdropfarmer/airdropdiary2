<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStrategiesTable extends Migration
{
    public function up()
    {
        Schema::table('strategies', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id')->nullable();
            $table->foreign('task_id', 'task_fk_8506757')->references('id')->on('tasks');
        });
    }
}
