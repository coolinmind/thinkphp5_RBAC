<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2017/12/22
 * Time: 17:32
 */

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Admin as AdminModel;
use think\Request;

class Base extends Controller
{

    public function __construct(Request $request = null)
    {
        //获取id
        if (!session('?auth', '', 'admin')) {
            $this->error('请登录', url('./login/index'), []);
        }
        $username = session('auth', '', 'admin');

        $model = new AdminModel();
        $id = $model->where(['name'=>$username])->value('id');

        //获取权限
        $auth = new Auth();
        $route = $request->path();
        $notCheck = ['admin/index','admin/data','authGroup/data','authRule/data'];

        if (!in_array($route, $notCheck)) {
            if (!$auth->check($route, $id)) {
                $this->error('没有权限', url('./admin/index'));
            }
        }

        $rule = $auth->getGroups($id);
        $ag = explode(',', $rule[0]['rules']);
        $map = [//子级
            'id'=> ['in',$ag],
            'status' =>1,
            'type' =>1
        ];

        $map1 = [ //父级
            'id'=> ['in',$ag],
            'status' =>1,
            'type' =>1,
            'level'=>0
        ];
        $data = db('auth_rule')->where($map)->order('pid')->select();
        $data2 = db('auth_rule')->where($map1)->order('pid')->select();

        $list = [];
        foreach ($data as $k => $v) {
            if ($v['level'] == 1) {
                $list[$k] = $v;
            }
        }
        // 赋值admin作用域
        session('auth_list', $data2, 'admin') ;
        session('list', $list, 'admin') ;

        parent::__construct();
    }

    //返回layui前端列表数据
    public function jump($msg = '', $code = null, $data = [], $count = [])
    {
        return ['code'=> $code, 'count'=>count($count), 'msg' => $msg, 'data' => $data];
    }

    //
    public function json($msg = '', $code = null, $data = '')
    {
        return json(['code'=> $code, 'count'=>count($data), 'msg' => $msg, 'data' => $data]);
    }
}
