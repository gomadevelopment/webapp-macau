<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChatMessagesTable extends Migration {

	public function up()
	{
		Schema::create('chat_messages', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('chat_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->text('message');
			$table->integer('order')->default('0');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('chat_messages');
	}
}