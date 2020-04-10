<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');

            $table->longText('texte');

            $table->integer('score')->nullable();

            $table->string('option_1');

            $table->boolean('correct_1')->default(0)->nullable();

            $table->string('option_2');

            $table->boolean('correct_2')->default(0)->nullable();

            $table->string('option_3')->nullable();

            $table->boolean('correct_3')->default(0)->nullable();

            $table->string('option_4')->nullable();

            $table->boolean('correct_4')->default(0)->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
