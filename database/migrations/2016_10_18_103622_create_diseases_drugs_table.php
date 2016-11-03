<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseasesDrugsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases_drugs', function (Blueprint $table) {
            $table->integer('disease_id')->unsigned();
            $table->integer('drug_id')->unsigned();


            $table->foreign('disease_id')->references('id')->on('diseases');
            $table->foreign('drug_id')->references('id')->on('drugs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('diseases_drugs');
    }
}
