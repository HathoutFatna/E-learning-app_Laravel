<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLeconsTable extends Migration
{
    public function up()
    {
        Schema::table('lecons', function (Blueprint $table) {
            $table->unsignedInteger('chapitre_id')->nullable();

            $table->foreign('chapitre_id', 'chapitre_fk_871052')->references('id')->on('chapitres');
        });
    }
}
