<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExameMediaTable extends Migration {

	public function up()
	{
		Schema::create('exame_media', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('exame_id')->unsigned();
			$table->string('media_url', 255);
			$table->string('media_type', 100)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('exame_media');
	}
}