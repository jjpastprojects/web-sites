<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_values', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('variable_id')->unsigned();
                $table->foreign('variable_id')->references('id')->on('variables')->onDelete('cascade');
                $table->string('value');
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
        Schema::drop('site_values');
    }
}
