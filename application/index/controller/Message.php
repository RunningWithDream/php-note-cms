<?php

namespace app\index\controller;

use app\index\model\Msg;
use think\Request;

class Message extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index($page=0,$limit=5)
    {
        $msgs['count'] = Msg::count();
        $msgs['page'] =$page;
        $msgs['limit'] =$limit;
        $msgs['data'] = Msg::page($page,$limit)->select();
        $this->assign(compact('msgs'));
        return $this->fetch();
    }

    public function page($page=0,$limit=5)
    {
//        $data = '{"code":0,"msg":"","count":29,"data":[{"id":10000,"title":"title-1","msg":"msg1"},{"id":10000,"title":"title-1","msg":"msg1"},{"id":10000,"title":"title-1","msg":"msg1"}]}';
        $data['code'] = 0;
        $data['msg'] = '';
        $data['count'] = Msg::count();
        $data['data'] = Msg::page($page,$limit)->select()->toArray();


        print_r(json_encode($data,true));

//        return json_decode($data,true);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $result = $this->validate(
            [
                'title'  => $request->title,
                'msg' => $request->msg,
            ],
            'app\index\validate\Msg');
        if (true !== $result) {
            return $this->failRes('数据异常',$result);
        }else{
            if (Msg::create(['msg' => $request->msg,'title'=>$request->title])) {
                return $this->suceessRes('添加成功',url("message/index"));
            }
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function read()
    {
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $msg = Msg::find($id);
        $this->assign(compact('msg'));
        return $this->fetch();
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
        $data['title'] = $request->title;
        $data['msg'] = $request->msg;

        echo 'id:'.$id;
        print_r($data);

        $result = $this->validate(
            [
                'title'  =>  $data['title'],
                'msg' => $data['msg'],
            ],
            'app\index\validate\Msg');
        if (true !== $result) {
            return $this->failRes('数据异常',$result);
        }else{
            if ( Msg::where('id', $id)->update($data)) {
                return $this->suceessRes('更新成功',url("message/index"));
            }
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        if(Msg::destroy($id)){
            return $this->suceessRes('删除成功',[]);
        }else{
            return $this->failRes('删除失败',[]);
        }
    }
}
