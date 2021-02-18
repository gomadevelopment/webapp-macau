<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExameQuestionItemMediaTable extends Migration {

	public function up()
	{
		Schema::create('exame_question_item_media', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('exame_question_item_id')->unsigned();
			$table->string('media_url', 255);
			$table->string('media_type')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('exame_question_item_media');
	}
}