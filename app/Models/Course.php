<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Course extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'courses';

    protected $appends = [
        'thumbnail',
    ];

    public static $searchable = [
        'name',
    ];

    const STATUS_SELECT = [
        '0' => 'Draft',
        '1' => 'Published',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'literature',
        'status',
        'hours',
        'credits',
        'video',
        'price',
        'created_at',
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

    public function courseActivities()
    {
        return $this->hasMany(Activity::class, 'course_id', 'id');
    }

    public function courcesSkills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function authors()
    {
        return $this->belongsToMany(User::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function getThumbnailAttribute()
    {
        $file = $this->getMedia('thumbnail')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
}
