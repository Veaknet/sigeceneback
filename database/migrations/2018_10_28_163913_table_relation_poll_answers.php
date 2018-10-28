<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRelationPollAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poll_answers', function (Blueprint $table) {
            $table->unsignedInteger('poll_id')->nullable();
            $table->unsignedInteger('question_id')->nullable();
            $table->unsignedInteger('poll_user_id')->nullable();
            $table->foreign('poll_id')
                ->references('id')->on('polls')
                ->onDelete('cascade');
            $table->foreign('question_id')
                ->references('id')->on('questions')
                ->onDelete('cascade');
            $table->foreign('poll_user_id')
                ->references('id')->on('poll_users')
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
        Schema::table('poll_answers', function (Blueprint $table) {
            //
        });
    }
}
