<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStrategyTaskPivotTable extends Migration
{
    public function up()
    {
        Schema::create('strategy_task', function (Blueprint $table) {
            $table->unsignedBigInteger('strategy_id');
            $table->foreign('strategy_id', 'strategy_id_fk_8506002')->references('id')->on('strategies')->onDelete('cascade');
            $table->unsignedBigInteger('task_id');
            $table->foreign('task_id', 'task_id_fk_8506002')->references('id')->on('tasks')->onDelete('cascade');
        });
    }
}