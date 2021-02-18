<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{

		Schema::table('exame_media', function(Blueprint $table) {
			$table->foreign('exame_id')->references('id')->on('exames')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{

		Schema::table('exame_media', function(Blueprint $table) {
			$table->dropForeign('exame_media_exame_id_foreign');
		});
	}
}