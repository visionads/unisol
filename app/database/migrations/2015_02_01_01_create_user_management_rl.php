<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserManagementRl extends Migration {

	public function up()
	{
        Schema::create('role', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code', 8);
            $table->string('title', 128);
            $table->text('description');
            $table->tinyInteger('status', false, 1);
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });



        Schema::create('department', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 128);
            $table->text('description');
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });




        Schema::create('user', function(Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password', 64);
            $table->string('email')->unique();
            $table->unsignedInteger('role_id')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->date('joint_date');
            $table->dateTime('last_visit');
            $table->string('ip_address', 16);
            $table->string('verified_code', 64);
            $table->string('csrf_token', 64);
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('user', function($table) {
            $table->foreign('role_id')->references('id')->on('role');
            $table->foreign('department_id')->references('id')->on('department');
        });




        Schema::create('user_profile', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('first_name',64);
            $table->string('middle_name',64);
            $table->string('last_name',64);
            $table->date('date_of_birth');
            $table->string('gender',64);
            $table->string('image',128);
            $table->string('city',32);
            $table->string('state',32);
            $table->string('country',64);
            $table->tinyInteger('zip_code', false, 5);
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('user_profile', function($table) {
            $table->foreign('user_id')->references('id')->on('user');
        });





        Schema::create('user_meta', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('fathers_name',64);
            $table->string('mothers_name',64);
            $table->string('fathers_occupation',64);
            $table->string('fathers_phone',16);
            $table->tinyInteger('freedom_fighter',false, 1);
            $table->string('mothers_occupation',64);
            $table->string('mothers_phone',16);
            $table->string('national_id',16);
            $table->string('driving_licence',16);
            $table->string('passport',16);
            $table->string('place_of_birth',64);
            $table->string('marital_status',64);
            $table->string('nationality',64);
            $table->string('religion',64);
            $table->string('signature',128);
            $table->text('present_address');
            $table->text('permanent_address');
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('user_meta', function($table) {
            $table->foreign('user_id')->references('id')->on('user');
        });




        Schema::create('user_academic_record', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('level_of_education',64);
            $table->string('degree_name',64);
            $table->string('institute_name',128);
            $table->string('board',32);
            $table->string('group',32);
            $table->string('major_subject',64);
            $table->string('result_type',64);
            $table->string('result',64);
            $table->string('grade',16);
            $table->decimal('grade_scale', 3, 2);
            $table->decimal('cgpa', 3, 2);
            $table->string('candidate_number', 64);
            $table->string('education_medium', 64);
            $table->string('study_at', 64);
            $table->tinyInteger('year_of_passing', false, 4);
            $table->string('duration',64);
            $table->string('certificate',64);
            $table->string('transcript',128);
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('user_academic_record', function($table) {
            $table->foreign('user_id')->references('id')->on('user');
        });




        Schema::create('user_miscellaneous_info', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->tinyInteger('ever_admit_this_university', false, 1);
            $table->tinyInteger('ever_dismiss', false, 1);
            $table->tinyInteger('academic_honors_received', false, 1);
            $table->tinyInteger('ever_admit_other_university', false, 1);
            $table->string('admission_test_center',128);
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('user_miscellaneous_info', function($table) {
            $table->foreign('user_id')->references('id')->on('user');
        });




        Schema::create('user_extra_curricular_activity', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('title', 128);
            $table->text('description');
            $table->string('achievement', 128);
            $table->string('certificate_medal', 128);
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('user_extra_curricular_activity', function($table) {
            $table->foreign('user_id')->references('id')->on('user');
        });




        Schema::create('user_supporting_doc', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('academic_goal_statement', 128);
            $table->text('essay');
            $table->string('letter_of_intent', 128);
            $table->string('personal_statement', 128);
            $table->string('research_statement', 128);
            $table->string('portfolio', 128);
            $table->string('resume', 128);
            $table->string('readmission_personal_details', 128);
            $table->string('other', 128);
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('user_supporting_doc', function($table) {
            $table->foreign('user_id')->references('id')->on('user');
        });




        Schema::create('user_reset_password', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->dateTime('reset_password_time');
            $table->dateTime('reset_password_expire');
            $table->string('reset_password_token');
            $table->tinyInteger('status', false, 1);
            $table->integer('created_by', false);
            $table->integer('updated_by', false);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('user_reset_password', function($table) {
            $table->foreign('user_id')->references('id')->on('user');
        });

	}


	public function down()
	{
        Schema::drop('role');
        Schema::drop('department');
        Schema::drop('user');
        Schema::drop('user_profile');
        Schema::drop('user_meta');
        Schema::drop('user_academic_record');
        Schema::drop('user_miscellaneous_info');
        Schema::drop('user_extra_curricular_activity');
        Schema::drop('user_supporting_doc');
        Schema::drop('user_reset_password');
	}

}