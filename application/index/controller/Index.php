<?php
namespace app\index\controller;

use app\index\model\Admin as AdminModel;

class Index extends Base
{

    public function getIndex()
    {
        $title = '首页';
        return view('index/index', compact('title'));
    }

    //显示数据
    public function getTest()
    {
        $data = db('admin')->order('id', 'desc')->select();
        $result = $this->jump('success', '0', $data);
        print_r($result);
    }

    public function getEdit()
    {
        $result = db('admin')->where(['id'=>input('id')])->find();
        $title = '修改';
        return view('index/edit', compact('result', 'title'));
    }

    public function postAdd()
    {
        //todo 验证
        $post = request()->post();
        $data['name'] = $post['username'];
        $data['password'] = $post['password'];
        $model = new AdminModel();
        if ($model->where(['id'=>$post['id']])->update($data)) {
            $this->success('更新成功', 'index/index');
        }
        $this->success('更新失败', 'index/index');
    }

    public function postDel()
    {
        $id = input('post.id');
        $result = db('admin')->where(['id'=>$id])->delete();
        if ($result) {
            return $this->json('删除成功', '200', []);
        }
        return $this->json('删除失败', '401', []);
    }
}
