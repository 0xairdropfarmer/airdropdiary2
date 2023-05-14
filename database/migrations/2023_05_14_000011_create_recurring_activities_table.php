<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecurringActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('recurring_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('total_interact')->nullable();
            $table->float('total_amount', 15, 2)->nullable();
            $table->float('total_gas_spend', 15, 2)->nullable();
            $table->string('done')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
