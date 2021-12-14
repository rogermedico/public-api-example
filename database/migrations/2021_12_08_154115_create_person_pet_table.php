<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonPetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_pet', function (Blueprint $table) {
            $table->bigInteger('person_id')->unsigned();
            $table->bigInteger('pet_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('pet_id')->references('id')->on('pets')->onDelete('cascade');
            $table->primary(['person_id','pet_id']);
            $table->date('adopted');
            $table->string('record_author');
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
        Schema::dropIfExists('person_pet');
    }
}
