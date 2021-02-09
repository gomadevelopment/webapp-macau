<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInquiriesTable extends Migration {

	public function up()
	{
		Schema::create('inquiries', function(Blueprint $table) {
			$table->increments('id');
			$table->text('question');
			$table->integer('order')->default('1');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('inquiries');
	}
}