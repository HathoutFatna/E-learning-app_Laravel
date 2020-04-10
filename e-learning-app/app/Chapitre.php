<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Chapitre extends Model
{
    use SoftDeletes;

    public $table = 'chapitres';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'titre',
        'cours_id',
        'position',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    public function chapitreLecons()
    {
        return $this->hasMany(Lecon::class, 'chapitre_id', 'id');
    }
    public function Lecons()
    {
        return $this->hasMany(Lecon::class);
    }

    public function cours()
    {
        return $this->belongsTo(Cour::class, 'cours_id');
    }

    public function scopeOfTeacher($query){
        if (!Auth::user()->isAdmin()){
            return $query->wherehas('cours', function($q){
                $q->wherehas('enseignants', function($qq){
                    $qq->where('user_id', Auth::user()->id);
            }); });
        }
        return $query;
    }
}
