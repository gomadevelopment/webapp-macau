<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChatsTable extends Migration {

	public function up()
	{
		Schema::create('chats', function(Blueprint $table) {
			$table->increments('id');
			$table->tinyInteger('is_group')->default('0');
			$table->integer('user_1_id')->unsigned()->nullable();
			$table->integer('user_2_id')->unsigned()->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('chats');
	}
}