<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildVaccinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_vaccinations', function (Blueprint $table) {
            $table->string('ChildId');
            $table->string('Vaccine');
            $table->primary(array('ChildId', 'Vaccine') );
            $table->string('Vitamin')->default('null');
            $table->string('MWId');
            $table->string('MWName');
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
        Schema::dropIfExists('child_vaccinations');
    }
}
