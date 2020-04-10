<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{

    public $table = 'categories';

    protected $fillable = ['nom',
        'created_at',
        'updated_at',
        'deleted_at',];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    //

    public $timestamps = true;
}
