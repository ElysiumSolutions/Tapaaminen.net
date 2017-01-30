<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('location')->nullable();
            $table->text('coordinates')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('organizer', 255)->nullable();
            $table->string('status')->default('open');

            $table->uuid('user_id')->nullable()->default(null); //user_id is null if not registered
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('slug', 255)->unique();
            $table->string('adminslug', 255)->unique();

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
        Schema::dropIfExists('meetings');
    }
}
