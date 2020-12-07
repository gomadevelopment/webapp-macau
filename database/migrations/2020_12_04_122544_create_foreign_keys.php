<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('student_classes', function(Blueprint $table) {
			$table->foreign('teacher_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('student_class_users', function(Blueprint $table) {
			$table->foreign('student_class_id')->references('id')->on('student_classes')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('student_class_users', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('student_classes', function(Blueprint $table) {
			$table->dropForeign('student_classes_teacher_id_foreign');
		});
		Schema::table('student_class_users', function(Blueprint $table) {
			$table->dropForeign('student_class_users_student_class_id_foreign');
		});
		Schema::table('student_class_users', function(Blueprint $table) {
			$table->dropForeign('student_class_users_user_id_foreign');
		});
	}
}