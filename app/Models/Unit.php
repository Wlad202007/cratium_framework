<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Unit extends Model
{
    use SoftDeletes;

    public $table = 'units';

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
        'type',
        'head_id',
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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
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
}
