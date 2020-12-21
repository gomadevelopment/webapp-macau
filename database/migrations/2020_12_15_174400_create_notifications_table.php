<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 100);
			$table->string('text', 255);
			$table->string('url', 250);
			$table->string('param1_text', 20);
			$table->string('param1', 20);
			$table->string('param2_text', 20);
			$table->string('param2', 20);
			$table->integer('type_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->tinyInteger('active')->default('1');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}