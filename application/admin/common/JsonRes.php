<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/10
 * Time: 8:25
 */

namespace app\admin\common;


trait JsonRes
{
//    public function jsonRes(ResCode $code,$data)
//    {
//        return ['state'=>$code[0],'msg'=> $code[1],'data'=>$data];
//    }
    public function successRes($msg,$data)
    {
        return ['state'=>0,'msg'=> $msg,'data'=>$data];
    }

    public function failRes($msg,$data)
    {
        return ['state'=>0,'msg'=> $msg,'data'=>$data];
    }

}