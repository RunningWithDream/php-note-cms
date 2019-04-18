<?php

namespace app\http\middleware;

use app\admin\common\JsonRes;
use app\admin\common\ResCode;

class ValidateLogin
{
    use JsonRes;

    public function handle($request, \Closure $next)
    {
        $res = $request->validate(['username'=>$request->username,'password'=>$request->password],'app\admin\validate\Login');
        if(true == $res){
            return $next($request);
        }else{
            $this->jsonRes(ResCode::LOGIN_INFO_ERROR,$res);
        }
    }
}
