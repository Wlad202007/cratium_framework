<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Activity extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'activities';

    public static $searchable = [
        'name',
    ];

    protected $appends = [
        'video',
        'files',
    ];

    const MODE_SELECT = [
        'active' => 'Active',
        'test'   => 'Test',
        'draft'  => 'Draft',
    ];

    protected $dates = [
        'time_start',
        'time_end',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TYPE_SELECT = [
        'lecture' => 'Lecture',
        'seminar' => 'Seminar',
        'module'  => 'Module',
        'exam'    => 'Exam',
        'lab'     => 'Lab',
        'setoff'  => 'Set-off',
    ];

    protected $fillable = [
        'name',
        'type',
        'score',
        'duration',
        'time_start',
        'time_end',
        'test_per_page',
        'time_per_test',
        'mode',
        'description',
        'course_id',
        'moderator_id',
        'priority',
        'author_id',
        'premise_id',
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

    public function activityQuestions()
    {
        return $this->hasMany(Question::class, 'activity_id', 'id');
    }

    public function activityScores()
    {
        return $this->hasMany(Score::class, 'activity_id', 'id');
    }

    public function getTimeStartAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTimeStartAttribute($value)
    {
        $this->attributes['time_start'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getTimeEndAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setTimeEndAttribute($value)
    {
        $this->attributes['time_end'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getVideoAttribute()
    {
        return $this->getMedia('video');
    }

    public function getFilesAttribute()
    {
        return $this->getMedia('files');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function checkins()
    {
        return $this->belongsToMany(User::class);
    }

    public function moderator()
    {
        return $this->belongsTo(User::class, 'moderator_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function premise()
    {
        return $this->belongsTo(Premise::class, 'premise_id');
    }
}
