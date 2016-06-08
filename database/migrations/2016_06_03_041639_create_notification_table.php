<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('notifications', function (Blueprint $table) {
          $table->increments('notif_id');
          $table->integer('id');//also known as user_id
          $table->integer('fromUser'); // id of the one that requested
          $table->integer('has_read');
          $table->integer('type_of_notif');
          $table->string('notif_message');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notifications');
    }
}
