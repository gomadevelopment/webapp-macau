<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExameQuestionItemsTable extends Migration {

	public function up()
	{
		Schema::create('exame_question_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('exame_question_id')->unsigned();
			$table->longText('text_1')->nullable();
			$table->longText('text_2')->nullable();
			$table->text('category')->nullable();
			$table->text('options_1')->nullable();
			$table->text('options_correct')->nullable();
			$table->text('options_answered');
			$table->integer('options_number')->default('0');
			$table->text('options_2')->nullable();
			$table->text('options_3')->nullable();
			$table->text('options_4')->nullable();
			$table->text('options_5')->nullable();
			$table->text('options_6')->nullable();
			$table->text('options_7')->nullable();
			$table->text('options_8')->nullable();
			$table->text('options_9')->nullable();
			$table->text('options_10')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('exame_question_items');
	}
}