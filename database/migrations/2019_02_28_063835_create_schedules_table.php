<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('client_id')->unsigned();
            $table->text('time');
            $table->text('keynotes');
            $table->text('visit_type');
            $table->text('task_status')->nullable();
            $table->text('response_keyword')->nullable();
            $table->text('next_followup_date')->nullable();
            $table->text('sales_status')->nullable();
            $table->text('reason')->nullable();
            $table->tinyInteger('created_by')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
