<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Cour extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'cours';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'titre',
        'categories_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(category::class, 'categories_id');
    }
    public function categoryy()
    {
        return $this->belongsTo(category::class);
    }

    public function coursChapitres()
    {
        return $this->hasMany(Chapitre::class, 'cours_id', 'id');
    }
    public function Chapitres()
    {
        return $this->hasMany(Chapitre::class);
    }
    public function NbChapitres()
    {
        return $this->hasMany(Chapitre::class, 'cours_id', 'id')->count();
    }

    public function coursQuizzes()
    {
        return $this->hasMany(Quiz::class, 'cours_id', 'id');
    }

    public function quiz(){
        return $this->HasOne(Quiz::class,'cours_id');
    }

    public function enseignants()
    {
        return $this->belongsToMany(User::class);
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'cours_students');
    }


    public function scopeOfTeacher($query){
        if (!Auth::user()->isAdmin()){
            return $query->wherehas('enseignants', function($q){
                $q->where('user_id', Auth::user()->id);
            });
        }
        return $query;
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }
    public function getImage(){

    }


}
