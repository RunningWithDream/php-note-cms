<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/17
 * Time: 17:12
 */

namespace app\admin\common;


trait ApiRes
{
    public function successRes($msg, $data=[])
    {
        return ['state' => 0, 'msg' => $msg, 'data' => $data];
    }

    public function failRes($msg, $data=[])
    {
        return ['state' => 1, 'msg' => $msg, 'data' => $data];
    }
}