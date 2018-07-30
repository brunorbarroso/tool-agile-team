<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParameterTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameter_task', function (Blueprint $table) {
            $table->integer('parameter_id')->unsigned();
            $table->integer('task_id')->unsigned();

            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('parameter_task');
    }
}
