<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Lecon extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'lecons';

    protected $appends = [
        'images',
        'fichiers',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'titre',
        'position',
        'texte_long',
        'created_at',
        'updated_at',
        'deleted_at',
        'chapitre_id',
        'description',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function chapitre()
    {
        return $this->belongsTo(Chapitre::class, 'chapitre_id');
    }

    public function getImagesAttribute()
    {
        $files = $this->getMedia('images');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
        });

        return $files;
    }

    public function getFichiersAttribute()
    {
        return $this->getMedia('fichiers');
    }
}
