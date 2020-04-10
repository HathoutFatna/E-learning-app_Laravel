<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('cour_user', function (Blueprint $table) {
            $table->unsignedInteger('cour_id');

            $table->foreign('cour_id', 'cour_id_fk_870985')->references('id')->on('cours')->onDelete('cascade');

            $table->unsignedInteger('user_id');

            $table->foreign('user_id', 'user_id_fk_870985')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
