<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Folder extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'folders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const COLOR_SELECT = [
        'default' => 'Default',
        'success' => 'Success',
        'warning' => 'Warning',
        'danger'  => 'Danger',
    ];

    protected $fillable = [
        'name',
        'color',
        'parent_id',
        'admin_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function parentFolders()
    {
        return $this->hasMany(Folder::class, 'parent_id', 'id');
    }

    public function foldersDocuments()
    {
        return $this->belongsToMany(Document::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
