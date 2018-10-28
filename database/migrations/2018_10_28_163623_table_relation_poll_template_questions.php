<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRelationPollTemplateQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poll_template_questions', function (Blueprint $table) {
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('template_id')->nullable();
            $table->unsignedInteger('poll_id')->nullable();
            $table->foreign('question_id')
                ->references('id')->on('questions')
                ->onDelete('cascade');
            $table->foreign('template_id')
                ->references('id')->on('templates')
                ->onDelete('cascade');
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
        Schema::table('poll_template_questions', function (Blueprint $table) {
            //
        });
    }
}
