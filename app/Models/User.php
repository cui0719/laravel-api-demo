<?php

namespace App\Models;

class User extends BaseModel
{
    protected $table ="user";

    protected $fillable = [
        'username',
        'password',
        'phone',
        'email',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'parse_status',
    ];

    protected $hidden = [
        'password',
    ];

    /* 用户状态 */
    const STATUS_ENABLE    = 0; // 启用
    const STATUS_FORZEN    = -1; // 冻结

    public static $status = [
        self::STATUS_ENABLE     => '启用',
        self::STATUS_FORZEN     => '冻结',
    ];

    /**
     * 自动登录
     *
     * @author Maggie Zhang<zmy19930904@gmail.com>
     * @return Model User|null
     */
    public static function autoLogin(Request $request = null)
    {
        static $user = null;
        if ($user) {
            return $user;
        }

        if ($request->has('api_token') || $request->header('api_token')) {
            $user = $request->user('api');
            return $user;
        }

        return null;
    }
}