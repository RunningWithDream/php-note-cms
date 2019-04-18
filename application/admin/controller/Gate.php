<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Gate extends Controller
{
    /**
     * 登录界面
     *
     * @return \think\Response
     */
    public function login()
    {
        return $this->fetch('admin/gate/login');
    }

    /**
     * 登录逻辑
     *
     * @return \think\Response
     */
    public function toLogin()
    {
       //
    }
    /**
     * 登出逻辑
     *
     * @return \think\Response
     */
    public function toLogout()
    {
        //
    }

}
