<?php

namespace App\Models;

use App\Notifications\VerifyUserNotification;
use App\Traits\Auditable;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use \DateTimeInterface;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, HasApiTokens, Auditable;

    public $table = 'users';

    public static $searchable = [
        'name',
        'degree',
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    const DEGREE_SELECT = [
        'aspirant' => 'Aspirant',
        'profesor' => 'Professor',
        'student'  => 'Student',
    ];

    protected $dates = [
        'verified_at',
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'last_name',
        'middle_name',
        'degree',
        'academic_status',
        'position',
        'approved',
        'verified',
        'verified_at',
        'verification_token',
        'phone',
        'email',
        'email_verified_at',
        'password',
        'team_id',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            if (auth()->check()) {
                $user->verified    = 1;
                $user->verified_at = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
                $user->save();
            } elseif (!$user->verification_token) {
                $token     = Str::random(64);
                $usedToken = User::where('verification_token', $token)->first();

                while ($usedToken) {
                    $token     = Str::random(64);
                    $usedToken = User::where('verification_token', $token)->first();
                }

                $user->verification_token = $token;
                $user->save();

                $registrationRole = config('panel.registration_default_role');

                if (!$user->roles()->get()->contains($registrationRole)) {
                    $user->roles()->attach($registrationRole);
                }

                $user->notify(new VerifyUserNotification($user));
            }
        });
    }

    public function headUnits()
    {
        return $this->hasMany(Unit::class, 'head_id', 'id');
    }

    public function headGroups()
    {
        return $this->hasMany(Group::class, 'head_id', 'id');
    }

    public function moderatorActivities()
    {
        return $this->hasMany(Activity::class, 'moderator_id', 'id');
    }

    public function userAnswers()
    {
        return $this->hasMany(Answer::class, 'user_id', 'id');
    }

    public function adminFolders()
    {
        return $this->hasMany(Folder::class, 'admin_id', 'id');
    }

    public function authorDocuments()
    {
        return $this->hasMany(Document::class, 'author_id', 'id');
    }

    public function authorReviews()
    {
        return $this->hasMany(Review::class, 'author_id', 'id');
    }

    public function userSignatures()
    {
        return $this->hasMany(Signature::class, 'user_id', 'id');
    }

    public function authorScores()
    {
        return $this->hasMany(Score::class, 'author_id', 'id');
    }

    public function userScores()
    {
        return $this->hasMany(Score::class, 'user_id', 'id');
    }

    public function authorPublications()
    {
        return $this->hasMany(Publication::class, 'author_id', 'id');
    }

    public function authorActivities()
    {
        return $this->hasMany(Activity::class, 'author_id', 'id');
    }

    public function userBills()
    {
        return $this->hasMany(Bill::class, 'user_id', 'id');
    }

    public function authorBills()
    {
        return $this->hasMany(Bill::class, 'author_id', 'id');
    }

    public function managersUnits()
    {
        return $this->belongsToMany(Unit::class);
    }

    public function membersGroups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function authorsCourses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function checkinActivities()
    {
        return $this->belongsToMany(Activity::class);
    }

    public function usersFolders()
    {
        return $this->belongsToMany(Folder::class);
    }

    public function sharesDocuments()
    {
        return $this->belongsToMany(Document::class);
    }

    public function getVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setVerifiedAtAttribute($value)
    {
        $this->attributes['verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
