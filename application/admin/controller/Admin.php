<?php

namespace app\admin\controller;

use app\admin\service\AdminService;
use think\Controller;
use think\Request;

class Admin extends Controller
{
    /**
     * 管理员列表
     *
     * @return \think\Response
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            $page = $this->request->param('page');
            $limit = $this->request->param('limit');
            $starTime = strtotime($this->request->param('start'));
            $endTime = strtotime($this->request->param('end'));
            $username = $this->request->param('username');

            $list = [];
            $where = [];
            if ($username) {
                $where[] = ['username', 'like', '%' . $username . '%'];
            }

            if (!empty($starTime) && !empty($endTime)) {
                $endTime = $endTime + 86400;
                $where[] = ['create_time', '>', '' . $starTime . ''];
                $where[] = ['create_time', '<', '' . $endTime . ''];
            } elseif (!empty($starTime) || !empty($endTime)) {
                $endTime = $endTime + 86400;
                if ($starTime) {
                    $where[] = ['create_time', '>', '' . $starTime . ''];
                } elseif ($endTime) {
                    $where[] = ['create_time', '<', '' . $endTime . ''];
                }
            }

            $count = AdminService::getService()->count($where);
            if (0 < $count) {
                $list = AdminService::getService()->page($where, $page, $limit);
                foreach ($list as $item) {
                    $item['edit_url'] = './admin-edit?id=' . $item['id'];
                    $item['delete_url'] = url("admin/admin/delete", array("id" => $item['id']));
                }
            }
            return ['code' => 0, 'msg' => '', 'count' => $count, 'data' => $list];

        }

        return $this->fetch('admin/admin/list');
    }


    /**
     * 函数名称:status
     * 函数描述:启用/禁用管理员账户
     * @return array
     */
    public function status()
    {
        $param = $this->request->post();
        if (!isset($param['id']) || !isset($param['status'])) return ['code' => 1, 'msg' => '缺少参数', 'data' => ''];
        AdminService::getService()->status($param['id'], $param['status']);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return $this->fetch('admin/admin/create');
    }

    /**
     * 保存新建的资源
     *
     * @return \think\Response
     */
    public function save()
    {
        $data = $this->request->only(["username", "phone", "email", "nickname", "role", "password", "repass"]);
        $data['status'] = 1;
        if (AdminService::getService()->create($data)) {
            return ['code' => 0, 'msg' => '保存成功', 'data' => []];
        } else {
            return ['code' => 1, 'msg' => '保存失败', 'data' => AdminService::getService()->getError()];
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @return \think\Response
     */
    public function edit()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) return json_encode(['code' => 1, 'msg' => '缺少参数', 'data' => []], true);
        $info = AdminService::getService()->get(['id' => $param['id']])[0];
        $this->assign(compact('info'));
        return $this->fetch('admin/admin/edit');
    }


    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update()
    {
        $param = $this->request->only(['id', 'nickname', 'role', 'password']);
        if (empty($param['password'])) {
            unset($param['password']);
        } else {
            $param['password'] = md5($param['password']);
        }
        AdminService::getService()->update($param);
        return ['code' => 0, 'msg' => '修改成功', 'data' => []];
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        if(AdminService::getService()->delete($id)){
            return ['code' => 0, 'msg' => '删除成功', 'data' => []];
        }else{
            return ['code' => 1, 'msg' => '删除失败', 'data' => []];
        }
    }

    /**
     * 函数名称:delMuti
     * 函数描述:多选删除
     */
    public function delMulti()
    {
        if(AdminService::getService()->delMulti($this->request->param('id')))return ['code' => 0, 'msg' => '删除成功', 'data' => []];
    }
    
}
