<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUniversitiesTable extends Migration {

	public function up()
	{
		Schema::create('universities', function(Blueprint $table) {
			$table->increments('id', true);
			$table->string('name', 200);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('universities');
	}
}