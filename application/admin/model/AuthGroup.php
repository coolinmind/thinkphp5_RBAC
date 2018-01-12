<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2017/12/28
 * Time: 14:32
 */

namespace app\admin\model;

use think\Model;

class AuthGroup extends Model
{
    protected $name = 'auth_group';

    public function setStatusAttr($value)
    {
        if ($value == 'on') {
            $value = 1;
        }
        return $value;
    }

    //关联权限表
    public function rule()
    {
        return $this->hasMany(AuthRule::class);
    }

    public function recursive($data, $pid = '0')
    {
        static $arr = [];
        foreach ($data as $k => $v) {
            if ($v['pid'] == $pid) {
                $v['dataId'] = $this->getParentId($v['id']);
                $arr[] = $v;
                $this->recursive($data, $v['id']);
            }
        }
        return $arr;
    }

    public function getParentId($id)
    {
        $rule = $this->rule()->where(['status'=>1])->select();
        return $this->getPid($rule, $id, true);
    }

    public function getPid($rule, $id, $clear = false)
    {
        static $arr = [];
        if ($clear) {
            $arr = array();
        }

        foreach ($rule as $k => $v) {
            if ($v['id'] == $id) {
                $arr[] = $v['id'];
                $this->getPid($rule, $v['pid'], false);
            }
        }
        asort($arr);
        $arrStr = implode('-', $arr);
        return $arrStr;
    }
}
