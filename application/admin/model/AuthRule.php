<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2017/12/28
 * Time: 14:33
 */

namespace app\admin\model;

use think\Model;

class AuthRule extends Model
{
    protected $name = 'auth_rule';

    public function groups()
    {
        return $this->belongsTo(AuthGroup::class);
    }
}
