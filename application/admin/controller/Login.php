<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/1/11
 * Time: 17:25
 */

namespace app\admin\controller;

use app\admin\model\Admin as AdminModel;
use think\Controller;

class Login extends Controller
{
    public function index()
    {
        $title = '登陆';
        return view('login/index', compact('title'));
    }

    public function login()
    {
        $username = input('post.username');
        $password = input('post.password');

        $model = new AdminModel();
        $pwd = $model->where(['name'=>$username])->value('password');
        if (!$pwd) {
            $this->error('用户名错误', url('./login/index'), []);
        }
        if (!password_verify($password, $pwd)) {
            $this->error('密码错误', url('./login/index'), []);
        }
        session('auth', $username, 'admin');
        $this->success('登陆成功', url('./admin/index'), []);
    }

    public function logout()
    {
        session('auth', null, 'admin');
        $this->success('退出成功', url('./login/index'), []);
    }
}
