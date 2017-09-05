<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Lembarek\Core\Countries\Countries;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {

                $table->increments('id');
                $table->string('name');
                $table->string('slug');
                $table->text('description');
                $table->string('links');
                $table->string('universities');
                $table->enum('filetype', ['pdf', 'rar', 'zip', 'jpeg', 'doc']);

                $table->enum('country', array_map(function ($value) {
                                return htmlentities($value, ENT_QUOTES);
                            }, Countries::$CountriesLongNames));

                $table->integer('year');
                $table->integer('semester');
                $table->string('faculty');
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
        Schema::drop('files');
    }
}
