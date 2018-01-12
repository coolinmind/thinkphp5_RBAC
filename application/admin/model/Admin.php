<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2017/12/25
 * Time: 14:14
 */

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    protected $name = 'admin';

    public function groups()
    {
        return $this->hasOne(AuthGroup::class, 'aid');
    }
}
