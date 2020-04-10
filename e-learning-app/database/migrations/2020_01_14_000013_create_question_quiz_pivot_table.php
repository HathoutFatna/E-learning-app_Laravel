<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionQuizPivotTable extends Migration
{
    public function up()
    {
        Schema::create('question_quiz', function (Blueprint $table) {
            $table->unsignedInteger('quiz_id');

            $table->foreign('quiz_id', 'quiz_id_fk_871093')->references('id')->on('quizzes')->onDelete('cascade');

            $table->unsignedInteger('question_id');

            $table->foreign('question_id', 'question_id_fk_871093')->references('id')->on('questions')->onDelete('cascade');
        });
    }
}
