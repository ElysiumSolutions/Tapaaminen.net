<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_settings', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('meeting_id');
            $table->foreign('meeting_id')->references('id')->on('meetings');
            $table->string('password')->nullable()->default(null);
            $table->boolean('comments')->default(true);
            $table->boolean('showemail')->default(true);
            $table->boolean('shoenames')->default(true);
            $table->boolean('socialmediabuttons')->default(true);
            $table->timestamp('endtime')->nullable()->defaults(null);
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
        Schema::dropIfExists('meeting_settings');
    }
}
