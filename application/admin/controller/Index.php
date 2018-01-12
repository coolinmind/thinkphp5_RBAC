<?php
namespace app\admin\controller;

use app\admin\validate\Admin as AdminValidate;

class Index extends Base
{
    public function index()
    {
        $title = '首页';
        return view('index/index', compact('title'));
    }

    //显示数据
    public function data()
    {
        $page = input('page') ? : '1';
        $limit = input('limit') ? : '10';
        $data = db('admin')->order('id', 'desc')->page($page, $limit)->select();
        $count = db('admin')->select();
        $result = $this->jump('success', '0', $data, $count);
//        var_export($result);die;
        print_r($result);
    }

    public function edit()
    {
        $result = db('admin')->where(['id'=>input('id')])->find();
        $title = '修改';
        return view('index/edit', compact('result', 'title'));
    }

    public function add()
    {
        $post = request()->post();
        $data['name'] = $post['username'];
        $data['password'] = $post['password'];
        //todo 验证

        $validate = new AdminValidate();

        if (!$validate->check($data)) {
            dump($validate->getError());
        }

        if (array_key_exists('id', $post)) {
            db('admin')->where(['id'=>$post['id']])->update($data);
            $this->success('更新成功', url('/admin/index'));
        } else {
            db('admin')->insert($data);
            $this->success('添加成功', url('/admin/index'));
        }
        $this->error('添加或更新失败', url('/admin/index'));
    }

    public function del()
    {
        $id = input('post.id') ? : '';
        $result = db('admin')->where(['id'=>$id])->delete();
        if ($result) {
            $this->success('删除成功', '200', []);
        }
        $this->error('删除失败', '401', []);
    }
}
