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
        if($this->request->isAjax()){
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

            if(!empty($starTime) && !empty($endTime)){
                $endTime = $endTime + 86400;
                $where[] = ['create_time', '>', '' . $starTime . ''];
                $where[] = ['create_time', '<', '' . $endTime . ''];
            }elseif(!empty($starTime) || !empty($endTime)){
                $endTime = $endTime + 86400;
                if ($starTime) {
                    $where[] = ['create_time', '>', '' . $starTime . ''];
                }elseif ($endTime){
                    $where[] = ['create_time', '<', '' . $endTime . ''];
                }
            }

            $count= AdminService::getService()->count($where);
            if (0 < $count) {
                $list = AdminService::getService()->page($where,$page,$limit);
                foreach ($list as $item){
                    $item['edit_url'] = url("admin-edit",array("id"));
                    $item['delete_url'] = $item['edit_url'];
                }
            }
            return ['code'=>0,'msg'=>'','count'=>$count,'data'=>$list];

        }

        return $this->fetch('admin/admin/list');
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
     * @param  int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        return $this->fetch('admin/admin/edit');
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
