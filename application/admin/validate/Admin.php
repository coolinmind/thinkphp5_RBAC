<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2017/12/25
 * Time: 17:57
 */

namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'name'  =>  'require|max:25',
        'password' =>  'require|min:6',
    ];

    protected $message = [
        'name.require'     => '用户名名称不得为空！',
        'name.unique'      => '用户名名称不得重复！',
        'name.max'      => '用户名名称不得超过25位！',
        'password.require' => '用户名密码不得为空！',
        'password.min'     => '密码不得少于6位！',
    ];

    protected $scene = [
        'add'  => ['name' => 'unique:admin|require|max:25', 'password' => 'require|min:6'],
        'edit' => ['name' => 'require', 'password' => 'require|min:6'],
    ];
}
