<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToChapitresTable extends Migration
{
    public function up()
    {
        Schema::table('chapitres', function (Blueprint $table) {
            $table->unsignedInteger('cours_id')->nullable();

            $table->foreign('cours_id', 'cours_fk_870992')->references('id')->on('cours');
        });
    }
}
