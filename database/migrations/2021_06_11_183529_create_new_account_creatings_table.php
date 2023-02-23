<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewAccountCreatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new__account__creatings', function (Blueprint $table) {
            $table->string('ChildId')->unique();
            $table->string('Id');
            $table->string('Days');
            $table->string('FullName');
            $table->string('InitializedName');
            $table->timestamp('BirthDate_Time');
            $table->string('Address');
            $table->string('District');
            $table->string('Area');
            $table->string('MotherName');
            $table->string('FatherName');
            $table->string('Email');
            $table->string('ContactNo');
            $table->string('AMWId');
            $table->string('AMWName');
            $table->string('RawPassword');
            $table->string('Password');
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
        //Schema::dropIfExists('new__account__creatings');
    }
}
