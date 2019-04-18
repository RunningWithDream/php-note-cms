<?php
namespace app\index\controller;

use app\index\common\JwtObj;

class Index extends Base
{
    public function index()
    {
        return $this->fetch();
//        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
    }

    public function login()
    {
        return $this->fetch();
    }


    public function bus()
    {
       return $this->fetch();
    }


    public function tologin()
    {
        $un=$this->request->username;
        $ps=$this->request->password;


        if ($un=="admin" && $ps=="123"){
            echo "<h2>登录成功!</h2><br/>";

            // 测试1 begin
            /*$payload = array('sub'=>'1234567890','name'=>'John Doe','iat'=>1516239022);
            $jwt = new Jwt();
            $token = $jwt->getToken($payload);
            echo "<pre>获取到的token是:<br/><textarea style='width: 250px;height: 200px;'>$token</textarea><br/>";*/

            // 测试2 begin
            $payload_test=array('iss'=>'admin','iat'=>time(),'exp'=>time()+300,'nbf'=>time(),'sub'=>'www.admin.com','jti'=>md5(uniqid('JWT').time()));
            $token_test=JwtObj::getToken($payload_test);
            echo "<pre>获取到的token_test是:<br/><textarea style='width: 250px;height: 200px;'>$token_test</textarea><br/>";

            echo "<a href=".url('bus').">跳转到主界面</a><br/>";
        }
        else
        {
            echo "<h2>用户名或密码错误!</h2><br/>";
        }
    }


    public function tobus()
    {
        $token = isset($_POST['token']) ? $_POST['token'] : '';

        if (!$token) {
            echo 'token error';
        }else{
//            $jwt = new Jwt();

            // 对token进行验证签名
            /*$getPayload=$jwt->verifyToken($token);
            if (false==$getPayload){
                echo "验证token失败";
                return;
            }
            echo "<br><br>";
            var_dump($getPayload);
            echo "<br><br>";
            //测试和官网是否匹配

            // 测试1 end
            */

            //对token_test进行验证签名
            $getPayload_test=JwtObj::verifyToken($token);
            if (false==$getPayload_test){
                echo "验证token失败或其他错误!<br/>";
                return;
            }
            else if(1==$getPayload_test){
                echo "token过期,请重新登录获取<br/>";
                return;
            }
            echo "<br><br>";
            var_dump($getPayload_test);
            echo "<br><br>";

            $iat = $getPayload_test["iat"];
            $exp = $getPayload_test["exp"];
            // Y-m-d H:i:s
            // D, d M Y H:i:s
            $timeformat = "Y-m-d H:i:s";
            $time = date($timeformat,$iat);
            echo "token获取时间:\t $time <br/>";
            echo "当前时间:\t".date($timeformat,time())."<br/>";
            echo "token过期时间:\t".date($timeformat,$exp)."<br/>";
            echo "<br><br>返回业务数据JSON给main.html";
            // 测试2 end
        }
    }

    
}
