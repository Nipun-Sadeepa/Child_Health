<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildBirthInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_birth_infos', function (Blueprint $table) {
            $table->string('BChildId')->unique();
            $table->integer('Height');
            $table->integer('WeightInKg');
            $table->integer('WeightInG');
            $table->integer('Perimeter');
            $table->string('Hospital');
            $table->timestamp('BirthDate');
            $table->string('DeliveredType');
            $table->integer('Apga1');
            $table->integer('Apga5');
            $table->integer('Apga10');
            $table->string('VitaminK');
            $table->string('Milk');
            $table->string('Sthapitaya');
            $table->string('Connection');
            $table->string('Test');
            $table->string('BCG');
            $table->string('SkinColor');
            $table->string('Eyes');
            $table->string('Pekaniya');
            $table->string('Temperature');
            $table->string('AMWId');
            $table->string('AMWName');
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
        Schema::dropIfExists('child_birth_infos');
    }
}
