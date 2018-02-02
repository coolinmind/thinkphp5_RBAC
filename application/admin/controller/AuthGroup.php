<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2017/12/27
 * Time: 10:00
 */

namespace app\admin\controller;

use app\admin\validate\AuthGroup as AuthGroupValidate;
use app\admin\model\AuthGroup as AuthGroupModel;

class AuthGroup extends Base
{
    public function index()
    {
        $title = '用户组';
        return view('auth_group/index', compact('title'));
    }

    //显示数据
    public function data()
    {
        $page = input('page') ? : '1';
        $limit = input('limit') ? : '10';

        $model = new AuthGroupModel();
        $data = $model->order('id', 'desc')->page($page, $limit)->select();
        $count = $model->select();

        $result = $this->jump('success', '0', $data, $count);

        return $result;
    }

    public function edit()
    {
        $title = '修改用户组';

        $result = AuthGroupModel::get(input('id'));
        //查权限
        $result->rules = explode(',', $result->rules);

        $model = new AuthGroupModel();
        $res = $model->rule()->where(['status'=>1])->select();
        $res = $model->recursive($res);

        return view('auth_group/edit', compact('result', 'rules', 'title', 'res'));
    }

    public function add()
    {
        if (request()->isPost()) {
            $post = request()->post();

            $data['title'] = $post['title'];
            $data['status'] = array_key_exists('status', $post) == 'on' ? 1 : 0;
            $data['rules'] = implode(',', $post['rules']);

            $validate = new AuthGroupValidate();
            $model = new AuthGroupModel();

            if (array_key_exists('id', $post)) {
                if (!$validate->scene('edit')->check($data)) {
                    $this->error($validate->getError(), url('/authGroup/index'));
                }
                $model->where(['id'=>$post['id']])->update($data);

                $this->success('更新成功', url('/authGroup/index'));
            } else {
                if (!$validate->scene('add')->check($data)) {
                    $this->error($validate->getError(), url('/authGroup/index'));
                }

                $model->save($data);
                $this->success('添加成功', url('/authGroup/index'));
            }

            $this->error('添加或更新失败', url('/authGroup/index'));
        }

        $title = '添加用户组';
        $model = new AuthGroupModel();
        $res = $model->rule()->where(['status'=>1])->select();
        $res = $model->recursive($res);

        return view('auth_group/create', compact('title', 'res'));
    }

    public function del()
    {
        $id = input('post.id') ? : '';
        $result = AuthGroupModel::destroy($id);
        if ($result) {
            $this->success('删除成功', '200', []);
        }
        $this->error('删除失败', '401', []);
    }
}
