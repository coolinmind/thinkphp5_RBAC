<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2017/12/22
 * Time: 17:32
 */

namespace app\index\controller;

use think\Controller;

class Base extends Controller
{

    public function jump($msg = '', $code = null, $data = '')
    {
        return json_encode(['code'=> $code, 'count'=>count($data), 'msg' => $msg, 'data' => $data], true);
    }

    public function json($msg = '', $code = null, $data = '')
    {
        return json(['code'=> $code, 'count'=>count($data), 'msg' => $msg, 'data' => $data]);
    }
}