<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2017/12/27
 * Time: 10:53
 */

namespace app\admin\validate;

use think\Validate;

class AuthRule extends Validate
{
    protected $rule = [
        'rules'  =>  'require',
        'title' =>  'require|max:25',
    ];

    protected $message = [
        'title.require'     => '用户组名称不得为空！',
        'title.unique'      => '用户组名称不得重复！',
        'title.max'      => '用户组名称不得超过25位！',
    ];

    protected $scene = [
        'add'  => ['title' => 'unique:auth_group|require|max:25', 'rules' => ''],
        'edit' => ['title' => 'require|max:25', 'rules' => ''],
    ];
}