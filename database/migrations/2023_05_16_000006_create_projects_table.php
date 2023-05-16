<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->longText('description')->nullable();
            $table->string('live')->nullable();
            $table->string('airdropcf')->nullable();
            $table->integer('raisefund')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
