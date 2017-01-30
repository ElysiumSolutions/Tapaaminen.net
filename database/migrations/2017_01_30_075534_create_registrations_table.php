<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');

            $table->uuid('meeting_id');
            $table->foreign('meeting_id')->references('id')->on('meetings');

            $table->uuid('time_id');
            $table->foreign('time_id')->references('id')->on('times');

            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('meetings');

            $table->longText('times');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
