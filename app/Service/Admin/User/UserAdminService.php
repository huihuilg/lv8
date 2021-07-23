<?php


namespace App\Service\Admin\User;


use App\Models\UserAdmin;
use App\Service\BaseService;

class UserAdminService extends BaseService
{

    /**
     * Notes: 用户
     * @param  int  $id
     * @param  false  $error
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed
     * @author huihu
     */
    public function find(int $id, $error = false)
    {
        return UserAdmin::query()->where('id', $id)->firstOr(function () use ($error) {
            if($error) {
                throw_response_code('用户不存在');
            }
        });
    }


}