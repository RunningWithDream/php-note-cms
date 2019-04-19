<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/19
 * Time: 15:57
 */

namespace app\admin\service;


use app\admin\model\Role;

class RoleService
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
            self::$service = new self;
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
        $data = Role::where($where)->page($page, $limit)->select();
        return $data;
    }

    /**
     * 函数名称:count
     * 函数描述:获取数据数量
     * @return \think\db\Query
     */
    public function count($where = [])
    {
        return Role::where($where)->count();
    }


    /**
     * 函数名称:validate
     * 函数描述:验证提交的管理员信息是否合法
     * @return bool
     */
    public function validation($data, $scene = [])
    {
        $validate = new \app\admin\validate\Role;
        if ($validate->scene($scene)->check($data)) {
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

        if (Role::create($data)) {
            return true;
        }

        return false;
    }
}