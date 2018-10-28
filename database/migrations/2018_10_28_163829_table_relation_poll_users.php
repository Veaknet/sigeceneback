<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRelationPollUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poll_users', function (Blueprint $table) {
            $table->unsignedInteger('poll_id')->nullable();
            $table->foreign('poll_id')
                ->references('id')->on('polls')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poll_users', function (Blueprint $table) {
            //
        });
    }
}
