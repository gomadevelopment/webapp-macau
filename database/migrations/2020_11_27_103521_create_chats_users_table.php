<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChatsUsersTable extends Migration {

	public function up()
	{
		Schema::create('chats_users', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('chat_id')->unsigned();
			$table->integer('is_admin')->default('0');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('chats_users');
	}
}