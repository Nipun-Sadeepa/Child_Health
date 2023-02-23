<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMWUpdatingInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_w_updating_infos', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('MidWifeId');
            $table->string('FullName');
            $table->string('InitializedName');
            $table->string('NationalId');
            $table->text('PermanentAddress');
            $table->string('Area');
            $table->string('ContactNo');
            $table->string('Email');
            $table->string('AMWId');
            $table->string('AMWName');
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
        Schema::dropIfExists('m_w_updating_infos');
    }
}
