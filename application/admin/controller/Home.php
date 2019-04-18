<?php

namespace app\admin\controller;

use think\cache\driver\Redis;
use think\Controller;
use think\facade\Cache;

class Home extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function admin()
    {
        return $this->fetch();
    }

    public function page()
    {
        return $this->fetch();
    }

    public function test()
    {
        $data = [
            'count' => 20,
            'limit' => 30,
            'data' => [
                ['name' => '黎明', 'age' => '28'],
                ['name' => '王珞丹', 'age' => '27'],
                ['name' => '李达', 'age' => '26'],
                ['name' => '名仕达', 'age' => '25'],
            ]
        ];
//        Cache::store('redis')->HSET('user_data',$data);
        $redis = new Redis();
        $redis->set('user', $data);
    }

    public function get()
    {
//        $key = Cache::store('redis')->get('user_data');
        $redis = new Redis();
        $key = $redis->get('user');
        var_dump($key);
    }
}
