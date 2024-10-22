<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursTable extends Migration
{
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->increments('id');

            $table->string('titre');

            $table->longText('description')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
