<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildUpdatingInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_updating_infos', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('ChildId');
            $table->string('FullName');
            $table->string('InitializedName');
            $table->text('Address');
            $table->string('Area');
            $table->string('ContactNo');
            $table->string('Email');
            $table->string('MotherName');
            $table->string('FatherName');
            $table->string('MWId');
            $table->string('MWName');
            $table->timestamp('Date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child_updating_infos');
    }
}
