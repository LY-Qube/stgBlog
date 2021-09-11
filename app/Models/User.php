<?php

namespace App\Models;

use App\Listeners\SendApproveNotification;
use App\Notifications\ApproveNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Join role of this user
     *
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Join posts of this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'creator_id');
    }

    /**
     * generate a UUID
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Authenticatable $model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }

    /**
     * check if is admin
     *
     * @return bool
     */
    public function getIsAdminAttribute()
    {
        return $this->role->role === 'admin';
    }


    public function sendEmailApprove($post)
    {
        $this->notify(new ApproveNotification($post));
    }


}
