<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\UserAdmin
 *
 * @property int $id
 * @property string $user_name
 * @property string|null $nickname 昵称
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $mobile
 * @property string $password
 * @property int $status 用户状态 1 启用 2 禁用
 * @property int $gender 性别，1：男 2：女 3：未知
 * @property string $avatar 头像图地址
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin filter(\App\Filters\QueryFilter $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAdmin whereUserName($value)
 * @mixin \Eloquent
 */
class UserAdmin extends Authenticatable implements JWTSubject
{

    use Filterable;

    const PREFIX_EMAIL_VERIFY = 'email_verify_code_';

    protected $table = 'l_user_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'nickname',
        'email',
        'password',
        'mobile',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'deleted_at'
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [

    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * 额外在 JWT 载荷中增加的自定义内容
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return ['role' => 'admin'];
    }
}
