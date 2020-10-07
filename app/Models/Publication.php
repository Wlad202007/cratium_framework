<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Publication extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait, Auditable;

    public $table = 'publications';

    protected $appends = [
        'document',
    ];

    const DATABASE_SELECT = [
        'other' => 'Other',
    ];

    public static $searchable = [
        'title',
        'type',
        'coauthors',
    ];

    const EDITION_SELECT = [
        'scopus' => 'Scopus',
        'other'  => 'Other',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TYPE_SELECT = [
        'article'      => 'Article',
        'thesis'       => 'Thesis',
        'dissertation' => 'Dissertation',
        'monograph'    => 'Monograph',
        'book'         => 'Book',
        'handbook'     => 'Handbook',
        'other'        => 'Other',
    ];

    protected $fillable = [
        'title',
        'date',
        'edition',
        'database',
        'url',
        'author_id',
        'edition_number',
        'pages_count',
        'location',
        'type',
        'coauthors',
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

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDocumentAttribute()
    {
        return $this->getMedia('document')->last();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
