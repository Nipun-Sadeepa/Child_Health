<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildRoutineDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child__routine_datas', function (Blueprint $table) {
            $table->string('ChildId');
            $table->integer('ClinicNo');
            $table->primary(array('ChildId', 'ClinicNo') );
            $table->integer('WeightInKg');
            $table->integer('WeightInG');
            $table->integer('Height');
            $table->integer('HeadPerimeter');
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
        Schema::dropIfExists('child__routine_datas');
    }
}
