<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeconsTable extends Migration
{
    public function up()
    {
        Schema::create('lecons', function (Blueprint $table) {
            $table->increments('id');

            $table->string('titre');

            $table->longText('description')->nullable();

            $table->longText('texte_long')->nullable();

            $table->integer('position')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
