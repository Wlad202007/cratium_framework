<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Unit extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait, Auditable;

    public $table = 'units';

    public static $searchable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TYPE_SELECT = [
        'administration' => 'Administration',
        'faculty'        => 'Faculty',
        'department'     => 'Department',
        'other'          => 'Other',
    ];

    protected $fillable = [
        'name',
        'type',
        'head_id',
        'parent_id',
        'financial_details',
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

    public function unitPremises()
    {
        return $this->hasMany(Premise::class, 'unit_id', 'id');
    }

    public function unitGroups()
    {
        return $this->hasMany(Group::class, 'unit_id', 'id');
    }

    public function unitDocuments()
    {
        return $this->hasMany(Document::class, 'unit_id', 'id');
    }

    public function parentUnits()
    {
        return $this->hasMany(Unit::class, 'parent_id', 'id');
    }

    public function unitBills()
    {
        return $this->hasMany(Bill::class, 'unit_id', 'id');
    }

    public function unitsTemplates()
    {
        return $this->belongsToMany(Template::class);
    }

    public function managers()
    {
        return $this->belongsToMany(User::class);
    }

    public function head()
    {
        return $this->belongsTo(User::class, 'head_id');
    }

    public function parent()
    {
        return $this->belongsTo(Unit::class, 'parent_id');
    }
}
