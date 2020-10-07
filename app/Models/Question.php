<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Question extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'questions';

    protected $appends = [
        'files',
    ];

    const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Disabled',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TYPE_SELECT = [
        'quiz'  => 'Quiz',
        'text'  => 'Text',
        'media' => 'Media',
    ];

    protected $fillable = [
        'question',
        'explanation',
        'score',
        'activity_id',
        'status',
        'created_at',
        'type',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function questionVariants()
    {
        return $this->hasMany(Variant::class, 'question_id', 'id');
    }

    public function getFilesAttribute()
    {
        return $this->getMedia('files');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }
}
