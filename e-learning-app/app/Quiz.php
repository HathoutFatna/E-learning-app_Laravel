<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;

    public $table = 'quizzes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'titre',
        'cours_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public function cours()
    {
        return $this->belongsTo(Cour::class, 'cours_id');
    }
}
