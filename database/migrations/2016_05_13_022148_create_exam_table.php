<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('exams', function (Blueprint $table) {
          $table->increments('exam_id');
          $table->string('exam_name');
          $table->integer('exam_time_limit');
          $table->integer('prof_id');
          $table->integer('group_id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('exams');
    }
}
