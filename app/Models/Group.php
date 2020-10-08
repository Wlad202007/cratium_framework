<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Group extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'groups';

    public static $searchable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'unit_id',
        'description',
        'head_id',
        'parent_id',
        'contact_student_id',
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

    public function parentGroups()
    {
        return $this->hasMany(Group::class, 'parent_id', 'id');
    }

    public function groupsCourses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function groupsFolders()
    {
        return $this->belongsToMany(Folder::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class);
    }

    public function head()
    {
        return $this->belongsTo(User::class, 'head_id');
    }

    public function parent()
    {
        return $this->belongsTo(Group::class, 'parent_id');
    }

    public function contact_student()
    {
        return $this->belongsTo(User::class, 'contact_student_id');
    }
}
