<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Home extends Controller
{
    /**
     * 后台登录主界面
     *
     * @return \think\Response
     */
    public function index()
    {
        return $this->fetch('admin/home/index');
    }

    /**
     * 欢迎界面
     *
     * @return \think\Response
     */
    public function welcome()
    {
        return $this->fetch('admin/home/welcome');
    }


}
