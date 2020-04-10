<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Question extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'questions';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'texte',
        'score',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'correct_1',
        'correct_2',
        'correct_3',
        'correct_4',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function questionsQuizzes()
    {
        return $this->belongsToMany(Quiz::class);
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
    public function Quizzes()
    {
        return $this->belongsToMany(Quiz::class,'question_quiz');
    }
}
