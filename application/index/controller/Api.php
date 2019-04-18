<?php

namespace app\index\controller;

use app\index\common\JWT;
use think\Controller;
use think\Request;

class Api extends Base
{

    public function encode()
    {
        //用户输入信息，验证通过下发token[中间里验证token]
        $uid = 1;//数据库查询
        $token = JWT::get_Instance()->setIssuer('tp.top')->setAudience('tp.org')->encode($uid);
    }

    public function decode()
    {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJub25lIiwianRpIjoiNGYxZzIzYTEyYWEifQ.eyJpc3MiOiJ0cC50b3AiLCJhdWQiOiJ0cC5vcmciLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU1NDc5NTMxNywibmJmIjoxNTU0Nzk1Mzc3LCJleHAiOjE1NTQ3OTg5MTcsInVpZCI6MX0.';
        $token = JWT::get_Instance()->decode($token);
        echo $token->getHeader('jti'); // will print "4f1g23a12aa"
        echo '<br>';
        echo $token->getClaim('iss'); // will print "http://example.com"
        echo '<br>';
        echo $token->getClaim('uid'); // will print "1"
        echo '<br>';
    }

    
}
