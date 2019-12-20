<?php
/**
 * Created by PhpStorm.
 * User: win10
 * Date: 2019/12/3
 * Time: 16:20
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Category----分类添加</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>

<form class="form-horizontal" role="form" action="{{url('category/store')}}" method="post">
    <!---全局辅助函数-->
    @csrf

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">分类名称:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="firstname"
                   name="cate_name" placeholder="请输入分类名称...">
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否显示:</label>
            <div class="col-sm-3">
                <label class="radio-inline">
                    <input type="radio" name="cate_show" value="1" checked> 是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="cate_show" value="2"> 否
                </label>
            </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否导航栏显示:</label>
            <div class="col-sm-3">
                <label class="radio-inline">
                    <input type="radio" name="cate_nav_show" value="1" checked> 是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="cate_nav_show" value="2"> 否
                </label>
            </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">父分类:</label>
        <div class="col-sm-2">
            <select class="form-control" name="parent_id">
                    <option>--请选择--</option>
                @foreach($cateInfo as $v)
                    <option value="{{$v->cate_id}}"><?php echo str_repeat("&nbsp;&nbsp;",$v->level*3);?>{{$v->cate_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">分类添加</button>
            &nbsp; &nbsp; &nbsp;
            <button type="button" class="btn btn-info">分类重置</button>
        </div>
    </div>
</form>

</body>

</html>
