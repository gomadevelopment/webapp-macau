<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersBlockedTable extends Migration {

	public function up()
	{
		Schema::create('users_blocked', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('user_blocked_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users_blocked');
	}
}