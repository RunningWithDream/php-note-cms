<?php /*a:2:{s:28:"../view/admin\role\list.html";i:1555665257;s:30:"../view/admin\common\base.html";i:1555657437;}*/ ?>
<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>后台管理-管理员管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="./xadmin/css/font.css">
    <link rel="stylesheet" href="./xadmin/css/xadmin.css">
    <link rel="stylesheet" href="./layui/css/layui.css">
    
</head>
<body>

<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
            <input class="layui-input" placeholder="开始日" name="start" id="start" autocomplete="off">
            <input class="layui-input" placeholder="截止日" name="end" id="end" autocomplete="off">
            <input type="text" name="username" placeholder="请输入用户名" autocomplete="off" class="layui-input">
            <button class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>

    <table id="list" lay-filter="users-table" class="layui-table"></table>

    <script type="text/html" id="oprate-bar">
        <div class="layui-btn-group">
            <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
        </div>
    </script>

    <script type="text/html" id="status-bar">
        <div class="layui-inline layui-form">
            <input type="checkbox" lay-skin="switch" lay-text="启用|禁用" data-id="{{d.id}}" lay-filter="status" {{d.status==1?'checked':''}}>
        </div>
    </script>


    <script type="text/html" id="tool-bar">
        <button class="layui-btn layui-btn-danger" lay-event="del-multi"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" lay-event="add-new"><i class="layui-icon "></i>添加</button>
    </script>

    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>角色名</th>
            <th>拥有权限规则</th>
            <th>描述</th>
            <th>状态</th>
            <th>操作</th>
        </thead>
        <tbody>
        <tr>
            <td>
                <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>1</td>
            <td>超级管理员</td>
            <td>会员列表，问题列表</td>
            <td>具有至高无上的权利</td>
            <td class="td-status">
                <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td>
            <td class="td-manage">
                <a onclick="member_stop(this,'10001')" href="javascript:;"  title="启用">
                    <i class="layui-icon">&#xe601;</i>
                </a>
                <a title="编辑"  onclick="x_admin_show('编辑','role-add.html')" href="javascript:;">
                    <i class="layui-icon">&#xe642;</i>
                </a>
                <a title="删除" onclick="member_del(this,'要删除的id')" href="javascript:;">
                    <i class="layui-icon">&#xe640;</i>
                </a>
            </td>
        </tr>
        </tbody>
    </table>

</div>

</body>
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="./xadmin/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="./xadmin/js/xadmin.js"></script>
<script type="text/javascript" src="./xadmin/js/cookie.js"></script>

<script>
    layui.use(['laydate', 'form', 'table'], function () {
        var laydate = layui.laydate, form = layui.form, $ = layui.jquery, table = layui.table;
        //数据表渲染
        var tableIns = table.render({
            elem: '#list'
            , url: '<?php echo url("admin/role/index"); ?>' //数据接口
            , page: {
                layout: ['prev', 'page', 'next', 'count'] //开启分页
            }
            ,toolbar:'#tool-bar'
            ,defaultToolbar:''
            , cols: [[ //表头
                {type: 'checkbox'}
                , {field: 'id', title: 'ID', width: 80}
                , {field: 'rolename', title: '角色名', width: 150}
                , {field: 'desc', title: '角色描述', width: 150}
                , {field: 'create_time', title: '创建时间', width: 200}
                , {field: 'status', title: '状态', width: 150, align: 'center', toolbar: '#status-bar'}
                , {title: '操作', toolbar: '#oprate-bar', minWidth: 200}
            ]]
        });

        //头工具监听
        table.on('toolbar(users-table)', function(obj){
            if(obj.event=='del-multi'){
                var checkStatus = table.checkStatus(obj.config.id);
                var data = checkStatus.data;
                if(data.length<=0){
                    layer.msg('请勾选数据');
                    return false;
                }
                data = getFieldArr(data,'id');
            }
            switch(obj.event){
                case 'add-new':
                    x_admin_show('添加角色','./role-add.html');
                    break;
                case 'del-multi':
                    //删除
                    tableOperate.del('<?php echo url("admin/admin/delMulti"); ?>',{id:data},function(data){
                        layer.msg(data.msg, {icon: 1, time: 1000},function () {
                            tableIns.reload();//删除表格行，并更新缓存
                        });
                    },function (data) {
                        layer.msg(data.msg, {icon: 2, time: 1000},function () {
                            tableIns.reload();//删除表格行，并更新缓存
                        });
                    });
                    break;
            };
        });

        //行监听
        table.on('tool(users-table)', function (obj) {
            var data = obj.data; //获得当前行数据
            var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
            var tr = obj.tr; //获得当前行 tr 的DOM对象
            switch (layEvent) {
                case 'edit':
                    x_admin_show('编辑信息',data.edit_url);
                    break;
                case 'del':
                    layer.confirm('确认要删除吗？', function (index) {
                        //发异步删除数据
                        $.post('<?php echo url("admin/Admin/delete"); ?>',{id:data.id},function (data) {
                            layer.msg('已删除!', {icon: 1, time: 1000},function () {
                                obj.del();//删除表格行，并更新缓存
                            });
                        });
                    });
                    break;
            }
        });

        //状态开关监听
        form.on('switch(status)', function (data) {
            $.post('<?php echo url("admin/Admin/status"); ?>',{id:$(data.elem).data('id'),status:data.elem.checked?1:0});
        });

        //开始时间
        laydate.render({
            elem: '#start' //指定元素
        });

        //结束时间
        laydate.render({
            elem: '#end' //指定元素
        });

    });

</script>

</html>