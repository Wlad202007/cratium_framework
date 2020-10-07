<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Document extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'documents';

    protected $appends = [
        'scan',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'int_number',
        'ext_number',
        'title',
    ];

    const TYPE_SELECT = [
        'financial' => 'Financial',
        'personal'  => 'Personal',
        'other'     => 'Other',
    ];

    const STATUS_SELECT = [
        'draft'   => 'Draft',
        'pending' => 'Pending',
        'Review'  => 'Review',
        'Signed'  => 'Signed',
    ];

    protected $fillable = [
        'int_number',
        'ext_number',
        'title',
        'body',
        'unit_id',
        'author_id',
        'type',
        'status',
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

    public function documentReviews()
    {
        return $this->hasMany(Review::class, 'document_id', 'id');
    }

    public function documentSignatures()
    {
        return $this->hasMany(Signature::class, 'document_id', 'id');
    }

    public function getScanAttribute()
    {
        return $this->getMedia('scan');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function shares()
    {
        return $this->belongsToMany(User::class);
    }

    public function folders()
    {
        return $this->belongsToMany(Folder::class);
    }
}
