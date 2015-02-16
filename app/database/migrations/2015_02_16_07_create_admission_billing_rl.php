<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionBillingRl extends Migration {

	public function up()
	{
        Schema::create('degree', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('year_id')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->string('title', 128);
            $table->text('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('total_credit', 16);
            $table->string('duration', 16);

            $table->tinyInteger('status', false)->lenght(1);
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('degree', function($table) {
            $table->foreign('year_id')->references('id')->on('year');
            $table->foreign('department_id')->references('id')->on('department');
        });

        Schema::create('billing_item', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 128);
            $table->text('description');
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });


        /* Schema::table('waiver', function($table) {
            $table->foreign('billing_details_id')->references('id')->on('billing_item');
        }); */


        Schema::create('degree_waiver', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('degree_id')->nullable();
            $table->unsignedInteger('waiver_id')->nullable();
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('degree_waiver', function($table) {
            $table->foreign('degree_id')->references('id')->on('degree');
            $table->foreign('waiver_id')->references('id')->on('waiver');
        });


        Schema::create('waiver_constraint', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('degree_waiver_id')->nullable();
            $table->tinyInteger('is_time_dependent', false)->lenght(1);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('level_of_education',array(
                'PSC', 'JSC', 'SSC', 'HSC', 'GRAD', 'UNDER_GRAD', 'BACHELOR', 'DIPLOMA', 'POST_GRAD', 'O_LEVEL', 'A_LEVEL'
            ));
            $table->string('gpa', 16);
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('waiver_constraint', function($table) {
            $table->foreign('degree_waiver_id')->references('id')->on('degree_waiver');
        });

        Schema::create('billing_schedule', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 128);
            $table->text('description');
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });


        Schema::create('billing_details', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('billing_item_id')->nullable();
            $table->unsignedInteger('billing_schedule_id')->nullable();
            $table->unsignedInteger('degree_id')->nullable();
            $table->string('cost', 16);
            $table->dateTime('deadline');
            $table->string('fined_cost', 16);
            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        Schema::table('billing_details', function($table) {
            $table->foreign('billing_item_id')->references('id')->on('billing_item');
            $table->foreign('billing_schedule_id')->references('id')->on('billing_schedule');
            $table->foreign('degree_id')->references('id')->on('degree');
        });
	}

	public function down()
	{
        Schema::drop('degree');
        Schema::drop('billing_item');
        //Schema::drop('waiver');
        Schema::drop('degree_waiver');
        Schema::drop('waiver_constraint');
        Schema::drop('billing_schedule');
        Schema::drop('billing_details');
	}

}
