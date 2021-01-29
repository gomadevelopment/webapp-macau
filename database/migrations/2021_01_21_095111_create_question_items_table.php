<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionItemsTable extends Migration {

	public function up()
	{
		Schema::create('question_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('question_id')->unsigned();
			$table->longText('text_1')->nullable();
			$table->longText('text_2')->nullable();
			$table->text('category')->nullable();
			$table->text('options_correct')->nullable();
			$table->text('options_1')->nullable();
			$table->text('options_2')->nullable();
			$table->text('options_3')->nullable();
			$table->text('options_4')->nullable();
			$table->text('options_5')->nullable();
			$table->text('options_6')->nullable();
			$table->text('options_7')->nullable();
			$table->text('options_8')->nullable();
			$table->text('options_9')->nullable();
			$table->text('options_10')->nullable();
			$table->integer('options_number')->default(0);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('question_items');
	}
}