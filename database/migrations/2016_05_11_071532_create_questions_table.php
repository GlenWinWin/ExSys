<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('questions', function (Blueprint $table) {
          $table->increments('question_id');
          $table->integer('exam_id');
          $table->integer('prof_id');
          $table->string('question');
          $table->string('answers');
          $table->string('a');
          $table->string('b');
          $table->string('c');
          $table->string('d');
          $table->string('type_of_question');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions');
    }
}
