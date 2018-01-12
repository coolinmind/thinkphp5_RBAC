<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:73:"D:\soft\laragon\www\tp5\public/../application/admin\view\admin\index.html";i:1515743587;s:65:"D:\soft\laragon\www\tp5\application\admin\view\public\header.html";i:1515727121;s:63:"D:\soft\laragon\www\tp5\application\admin\view\public\left.html";i:1515756111;s:65:"D:\soft\laragon\www\tp5\application\admin\view\public\footer.html";i:1515727215;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $title; ?> - 后台系统</title>
    <link rel="stylesheet" type="text/css" href="_admin_/css/layui.css" />
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo" >后台布局</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <!--<ul class="layui-nav layui-layout-left ">
            <li class="layui-nav-item "><a href="">控制台</a></li>
            <li class="layui-nav-item"><a href="">商品管理</a></li>
            <li class="layui-nav-item"><a href="">用户</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">其它系统</a>
                <dl class="layui-nav-child">
                    <dd><a href="">邮件管理</a></dd>
                    <dd><a href="">消息管理</a></dd>
                    <dd><a href="">授权管理</a></dd>
                </dl>
            </li>
        </ul>-->
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                    <?php if(session('?auth','','admin')): ?>
                       <?php echo session('auth','','admin'); endif; ?>
                </a>
                <!--<dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                </dl>-->
            </li>
            <li class="layui-nav-item">
                <form action="<?php echo url('./login/logout'); ?>" method="post">
                    <button class="layui-btn layui-btn-sm" type="submit" href="#">退了</button>
                </form>
            </li>
        </ul>
    </div>
    <div class="layui-side layui-bg-black" >
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                <?php foreach(session('auth_list','','admin') as $k=>$v): ?>
                    <li class="layui-nav-item layui-nav-itemed">
                        <?php if($v['level'] == 0): ?>
                        <a class="" href="javascript:;"><?php echo $v['title']; ?><span class="layui-nav-more"></span></a>
                        <?php endif; foreach(session('list','','admin') as $k1=>$v1): if($v1['pid'] == $v['id']): ?>
                        <dl class="layui-nav-child">
                            <dd><a href=""><?php echo $v1['title']; ?></a></dd>
                        </dl>
                        <?php endif; endforeach; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div style="padding: 15px;">
            <div class="layui-btn-group">
                <a class="layui-btn layui-bg-orange" href="<?php echo url('./admin/add'); ?>" data-type="getCheckData">添加管理员</a>
            </div>
            <table lay-filter="table" class="layui-table" id="table"></table>
        </div>
    </div>
    
    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © 底部固定区域
    </div>
</div>
<script type="text/javascript" src="_admin_/layui.all.js"></script>
<script type="text/javascript" src="_admin_/jquery.js"></script>
<script type="text/html" id="admin">
    <a class="layui-btn layui-btn-primary layui-btn-xs" href="/admin/edit?id={{d.id}}">查看</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script>
    layui.use(['layer','table'], function() {
        var table = layui.table;
        //列表
        table.render({
            elem: '#table',
            page:true,
            url:"<?php echo url('/admin/data'); ?>",
            cols: [[
                {field:'id', title:'ID', width: 100}
                ,{field:'name', title:'用户名', width:200}
                ,{field:'password', title:'密码', width:200}
                ,{field:'create_time', title:'创建时间', width:200}
                ,{fixed: 'right', width:200, align:'center', title:'操作', toolbar: '#admin'}
            ]]
        });

        ///监听工具条
        table.on('tool(table)', function(obj){
            var data = obj.data;
            if(obj.event === 'del') {
                layer.confirm('真的删除行么', function(index){
                    obj.del();
                    layer.close(index);
                    $.ajax({
                        dataType : 'json',
                        type : 'POST',
                        url : "<?php echo url('/admin/del'); ?>",
                        data : {'id':data.id},
                        success : function(result){
                            layer.msg(result.msg);
                        },
                        error : function(result){
                            layer.msg(result.msg)
                        }
                    });
                });
            }
        });
    });
</script>
</body>
</html>