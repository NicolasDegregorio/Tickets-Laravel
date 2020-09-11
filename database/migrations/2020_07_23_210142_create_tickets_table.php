<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->timestamps();
            $table->integer('priority_id')->unsigned();
            $table->integer('institution_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            //relations
            $table->foreign('priority_id')->references('id')->on('priorities');
            $table->foreign('institution_id')->references('id')->on('institutions');
            $table->foreign('state_id')->references('id')->on('states');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
