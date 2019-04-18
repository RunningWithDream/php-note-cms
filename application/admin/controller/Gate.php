<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Gate extends Controller
{
    public function login()
    {
        return $this->fetch();
    }

    public function toLogin()
    {
        //校验密码
        echo '数据库校验密码';

        //
        echo '生成token写入用户信息';

        //跳转


        echo '跳转';
    }

}
