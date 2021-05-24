<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $role
 * @property Carbon|null $email_verified_at
 * @property string|null $avatar
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRole($value)
 * @method static Builder|User whereUpdatedAt($value)
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;

    /** @var string */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'manager_id',
        'manager',
        'cost_center_id',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Get the manager associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function manager()
    {
        return $this->hasOne(User::class, 'id', 'manager_id');
    }

    /**
     * Get the isManager associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function isManager()
    {
        return $this->hasOne(User::class, 'manager_id', 'id');
    }


    /**
     * Get the costCenter associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function costCenter()
    {
        return $this->hasOne(CostCenter::class, 'id', 'cost_center_id');
    }

   /**
    * The asset that belong to the User
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function asset(): BelongsToMany
   {
       return $this->belongsToMany(Asset::class)->using(AssetUser::class);
   }

   /**
    * Get all of the assetUser for the User
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function assetUser(): HasMany
   {
       return $this->hasMany(AssetUser::class, 'employee', 'id');
   }

}
