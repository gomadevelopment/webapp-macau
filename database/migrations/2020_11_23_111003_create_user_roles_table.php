<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserRolesTable extends Migration {

	public function up()
	{
		Schema::create('user_roles', function(Blueprint $table) {
			$table->increments('id', true);
			$table->string('role', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('user_roles');
	}
}