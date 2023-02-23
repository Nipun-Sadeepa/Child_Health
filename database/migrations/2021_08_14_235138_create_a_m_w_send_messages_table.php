<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAMWSendMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_m_w_send_messages', function (Blueprint $table) {
            $table->increments('Id')->autoIncrement();
            $table->string('AMWClient');
            $table->string('Subject');
            $table->text('Message');
            $table->date('ScheduledDate')->nullable();
            $table->time('ScheduledTime')->nullable();
            $table->string('ScheduledVenue')->default('Not Mentioned');
            $table->string('AMWId');
            $table->string('AMWName');
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
        Schema::dropIfExists('a_m_w_send_messages');
    }
}
