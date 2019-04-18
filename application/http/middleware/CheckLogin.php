<?php

namespace app\http\middleware;

class CheckLogin
{
    public function handle($request, \Closure $next)
    {
        //执行检测操作
        echo "检测token";
        //cookkie是否有token
        $token_flag = true;
        if(!$token_flag){
            return redirect('index/login');
        }
        return $next($request);

    }
}
