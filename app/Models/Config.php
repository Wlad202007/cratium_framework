<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Config extends Model
{
    use SoftDeletes;

    public $table = 'configs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'term',
        'value',
        'parent_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function parentConfigs()
    {
        return $this->hasMany(Config::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Config::class, 'parent_id');
    }
}
