<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMidWifeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mid_wife_details', function (Blueprint $table) {
            $table->string('MidWifeId')->unique();
            $table->string('Id');
            $table->string('RegisterdYear');
            $table->string('RegisterdDistrict');
            $table->string('FullName');
            $table->string('InitializedName');
            $table->string('NationalId');
            $table->text('PermanentAddress');
            $table->string('Area');
            $table->string('ContactNo');
            $table->string('Email');
            $table->string('RawPassword');
            $table->string('Password');
            $table->boolean('AdminPromoted')->default(0);
            $table->timestamp('PromotedDate')->nullable();
            $table->string('PromotedAMWId')->nullable();
            $table->string('PromotedAMWName')->nullable();
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
        Schema::dropIfExists('mid_wife_details');
    }
}
