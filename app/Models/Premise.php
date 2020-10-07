<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Premise extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'premises';

    public static $searchable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const TYPE_SELECT = [
        'dormitory'  => 'dormitory',
        'auditorium' => 'auditorium',
        'other'      => 'other',
    ];

    protected $fillable = [
        'name',
        'unit_id',
        'capacity',
        'type',
        'address',
        'gps',
        'created_at',
        'parent_id',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function parentPremises()
    {
        return $this->hasMany(Premise::class, 'parent_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function parent()
    {
        return $this->belongsTo(Premise::class, 'parent_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
