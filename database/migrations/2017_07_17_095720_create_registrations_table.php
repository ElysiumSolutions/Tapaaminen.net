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

	        $table->longText('times');

	        $table->uuid('meeting_id');
	        $table->foreign('meeting_id')->references('id')->on('meetings');

	        $table->uuid('user_id')->nullable()->default(null);
	        $table->foreign('user_id')->references('id')->on('users');

	        $table->string('username');

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
        Schema::dropIfExists('registrations');
    }
}
