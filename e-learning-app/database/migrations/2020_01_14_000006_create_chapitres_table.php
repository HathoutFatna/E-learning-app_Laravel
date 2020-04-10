<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapitresTable extends Migration
{
    public function up()
    {
        Schema::create('chapitres', function (Blueprint $table) {
            $table->increments('id');

            $table->string('titre');

            $table->longText('description')->nullable();

            $table->integer('position')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
