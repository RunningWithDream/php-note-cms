<?php

namespace app\index\controller;

use think\Request;
use \app\index\model\News as NewsModel;

class News extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            $param = $this->request->only(['page', 'limit']);
            $page = $param['page'];
            $limit = $param['limit'];
            $datas = NewsModel::limit($limit)->page($page)->select();
            foreach ($datas as $data) {
                $data['read'] = '/news/' . $data['news_id'];
                $data['edit'] = '/news/' . $data['news_id'] . '/edit';
                $data['delete'] = '/news/' . $data['news_id'];
            }
            $count = count($datas);
            return ['code' => 0, 'msg' => '', 'count' => $count, 'data' => $datas];
        }
        return $this->fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return $this->fetch('news/info');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save()
    {
        if (NewsModel::create($this->request->only(['title', 'auther', 'sub', 'content'])))
            return $this->successRes('保存成功');
        else
            return $this->failRes('保存失败');
    }

    /**
     * 显示指定的资源
     *
     * @param  int $news_id
     * @return \think\Response
     */
    public function read($news_id = false)
    {
        if ($news_id) $this->failRes('参数错误');
        $news_info = NewsModel::get($news_id);
        $flag = 'disabled';
        $this->assign(compact('flag'));
        $this->assign(compact('news_info'));
        return $this->fetch('news/info');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int $news_id
     * @return \think\Response
     */
    public function edit($news_id = false)
    {
        if ($news_id) $this->failRes('参数错误');
        $news_info = NewsModel::get($news_id);
        $flag = '';
        $this->assign(compact('flag'));
        $this->assign(compact('news_info'));
        return $this->fetch('news/info');
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
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete($news_id)
    {
        if (NewsModel::destroy($news_id)) {
            return 'success';
        }
    }
}
