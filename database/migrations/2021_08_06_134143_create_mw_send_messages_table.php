<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMWSendMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_w__send__messages', function (Blueprint $table) {
            $table->increments('Id')->autoIncrement();
            $table->string('MWClient');
            $table->string('Subject');
            $table->text('Message');
            $table->date('ScheduledDate')->nullable();
            $table->time('ScheduledTime')->nullable();
            $table->string('ScheduledVenue')->default('Not Mentioned');
            $table->string('MWId');
            $table->string('MWName');
            $table->boolean('Read')->default(0);
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
        Schema::dropIfExists('m_w__send__messages');
    }
}
