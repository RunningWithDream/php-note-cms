<?php

namespace app\admin\controller;

use app\admin\service\RoleService;
use think\Controller;
use think\Request;

class Role extends Controller
{
    /**
     * 角色列表
     *
     * @return \think\Response
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            $param = $this->request->param();
            $where = [];
            $count = RoleService::getService()->count($where);
            if(0 < $count){
                $list = RoleService::getService()->page($where, $param['page'], $param['limit']);
                foreach ($list as $item){
                    $item['edit_url'] = './amdin-edit';
                    $item['delete_url'] ='';
                }
            }

            return ['code' => 0, 'msg' => '', 'count' => $count, 'data' => $list];
        }
        return $this->fetch('admin/role/list');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return $this->fetch('admin/role/create');
    }


    public function test()
    {
        echo 'role-test';
    }
    
    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save()
    {
        echo 'role-save';

        echo THINK_VERSION;

//        if(RoleService::getService()->create($this->request->only(['rolename','desc']))){
//            return ['code'=>'0','msg'=>'保存成功','data'=>[]];
//        }else{
//            return ['code'=>'1','msg'=>'保存失败','data'=>[]];
//        }
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
        //
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
