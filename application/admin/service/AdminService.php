<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/18
 * Time: 14:27
 */

namespace app\admin\service;


use app\admin\model\Admin;

class AdminService
{

    private $error = '';
    private static $service = NULL;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * 函数名称:getService
     * 函数描述:单例模式获取服务实例
     * @return AdminService|null
     */
    public static function getService()
    {
        if (NULL == self::$service) {
            self::$service = new AdminService;
        }
        return self::$service;
    }

    /**
     * 函数名称:page
     * 函数描述:
     * @param array $where 搜索条件
     * @param int $page 搜索页数
     * @param int $limit 每页条数
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function page($where = [], $page = 1, $limit = 10)
    {
        $data = Admin::where($where)->page($page, $limit)->select();
        return $data;
    }

    /**
     * 函数名称:count
     * 函数描述:获取数据数量
     * @return \think\db\Query
     */
    public function count($where = [])
    {
        return Admin::where($where)->count();
    }

    /**
     * 函数名称:validate
     * 函数描述:验证提交的管理员信息是否合法
     * @return bool
     */
    public function validation($data)
    {
        $validate = new \app\admin\validate\Admin;
        if ($validate->check($data)) {
            return true;
        }
        $this->error = $validate->getError();
        return false;
    }

    /**
     * 函数名称:create
     * 函数描述:保存管理员信息
     * @param $data 保存的数据集合
     */
    public function create($data)
    {
        if (!$this->validation($data)) {
            return false;
        }

        if ($this->getByName($data['username'])) {
            $this->error = '该用户名已存在';
            return false;
        }

        if ($this->getByPhone($data['phone'])) {
            $this->error = '该手机已存在';
            return false;
        }

        if ($this->getByEmail($data['email'])) {
            $this->error = '该邮箱已存在';
            return false;
        }

        $data['password'] = md5($data['password']);
        if (Admin::create($data)) {
            return true;
        }

        return false;
    }

    /**
     * 函数名称:getByName
     * 函数描述:根据用户名获取用户信息
     * @param $username
     */
    public function getByName($username)
    {
        return Admin::where('username', $username)->select()->toArray();
    }

    /**
     * 函数名称:getByPhone
     * 函数描述:根据手机获取用户信息
     * @param $phone
     */
    public function getByPhone($phone)
    {
        return Admin::where('phone', $phone)->select()->toArray();
    }

    /**
     * 函数名称:getByEmail
     * 函数描述:根据email获取用户信息
     * @param $email
     */
    public function getByEmail($email)
    {
        return Admin::where('email', $email)->select()->toArray();
    }

    /**
     * 函数名称:getError
     * 函数描述:获取错误
     */
    public function getError()
    {
        return $this->error;
    }
}