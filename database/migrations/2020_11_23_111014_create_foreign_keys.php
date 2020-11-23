<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('user_role_id')->references('id')->on('user_roles')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('university_id')->references('id')->on('universities')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_user_role_id_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_university_id_foreign');
		});
	}
}