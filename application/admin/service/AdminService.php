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
    public function validation($data, $scene = [])
    {
        $validate = new \app\admin\validate\Admin;
        if ($validate->scene($scene)->check($data)) {
            return true;
        }
        $this->error = $validate->getError();
        return false;
    }

    /**
     * 函数名称:status
     * 函数描述:管理员是否启用
     * @param $id
     * @param $status
     */
    public function status($id, $status)
    {
        Admin::update(['id' => $id, 'status' => $status]);
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

        if ($this->get(['username' => $data['username']])) {
            $this->error = '该用户名已存在';
            return false;
        }

        if ($this->get(['phone' => $data['phone']])) {
            $this->error = '该手机已存在';
            return false;
        }

        if ($this->get(['email' => $data['email']])) {
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
     * 函数名称:update
     * 函数描述:更新信息
     */
    public function update($data)
    {
        Admin::update($data);
    }

    /**
     * 函数名称:delete
     * 函数描述:根据索引删除
     * @param $id
     */
    public function delete($id)
    {
        return Admin::where(['id' => $id])->delete();
    }


    /**
     * 函数名称:delMulti
     * 函数描述:批量删除
     * @param $ids
     */
    public function delMulti($ids)
    {
        return Admin::destroy($ids);
    }

    /**
     * 函数名称:get
     * 函数描述:获取账户信息
     * @param $where
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function get($where)
    {
        return Admin::where($where)->select()->toArray();
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