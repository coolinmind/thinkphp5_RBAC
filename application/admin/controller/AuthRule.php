<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2017/12/27
 * Time: 10:00
 */

namespace app\admin\controller;

use app\admin\validate\AuthRule as AuthRuleValidate;
use app\admin\model\AuthRule as AuthRuleModel;

class AuthRule extends Base
{
    public function index()
    {
        $title = '权限';
        return view('auth_rule/index', compact('title'));
    }

    //显示数据
    public function data()
    {
        $page = input('page') ? : '1';
        $limit = input('limit') ? : '10';
        $model = new AuthRuleModel();
        $data = $model->order('id', 'desc')->page($page, $limit)->select();
        $count = $model->select();
        $result = $this->jump('success', '0', $data, $count);
        return $result;
    }

    public function edit()
    {
        $model = new AuthRuleModel();
        $result = $model->where(['id'=>input('id')])->find();
        $title = '修改';
        return view('auth_rule/edit', compact('result', 'title'));
    }

    public function add()
    {
        if (request()->isPost()) {
            $post = request()->post();
            $data['name'] = $post['name'];
            $data['title'] = $post['title'];

            if (array_key_exists('status', $post)) {
                $data['status'] = $post['status'] === 'on' ? 1 : 0;
            } else {
                $data['status'] =  0;
            }

            $validate = new AuthRuleValidate();
            $model = new AuthRuleModel();
            if (array_key_exists('id', $post)) {
                if (!$validate->scene('edit')->check($data)) {
                    $this->error($validate->getError(), url('/authRule/index'));
                }

                $model->where(['id'=>$post['id']])->update($data);
                $this->success('更新成功', url('/authRule/index'));
            } else {
                if (!$validate->scene('add')->check($data)) {
                    $this->error($validate->getError(), url('/authRule/index'));
                }

                $model->insert($data);
                $this->success('添加成功', url('/authRule/index'));
            }
            $this->error('添加或更新失败', url('/authRule/index'));
        }
        $title = '添加页面';
        return view('auth_rule/create', compact('title'));
    }

    public function del()
    {
        $id = input('post.id') ? : '';
        $result = AuthRuleModel::destroy($id);
        if ($result) {
            $this->success('删除成功', '200', []);
        }
        $this->error('删除失败', '401', []);
    }


}
