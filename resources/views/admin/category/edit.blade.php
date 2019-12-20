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
    <title>Category----分类编辑</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>

<form class="form-horizontal" role="form" action="{{url('category/update/'.$info->cate_id)}}" method="post">
    <!---全局辅助函数-->
    @csrf

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">分类名称:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="firstname"
                   name="cate_name" value="{{$info->cate_name}}" placeholder="请输入分类名称...">
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否显示:</label>
            <div class="col-sm-3">
                <label class="radio-inline">
                @if($info->cate_show==1)
                     <input type="radio" name="cate_show" value="1" checked> 是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <input type="radio" name="cate_show" value=="2"> 否
                @else
                    <input type="radio" name="cate_show" value="1"> 是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="cate_show" value="2" checked> 否
                @endif
                </label>
            </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">是否导航栏显示:</label>
            <div class="col-sm-3">
                <label class="radio-inline">
                    @if($info->cate_nav_show==1)
                        <input type="radio" name="cate_nav_show" value="1" checked> 是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="cate_nav_show" value="2"> 否
                    @else
                        <input type="radio" name="cate_nav_show" value="1"> 是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="cate_nav_show" value="2" checked> 否
                    @endif
                </label>
            </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">父分类:</label>
        <div class="col-sm-2">
            <select class="form-control" name="praent_id">
                    <option>--请选择--</option>
                @foreach($cateInfo as $v)
                    @if($info->cate_id==$v->cate_id)
                    <option value="{{$v->cate_id}}" selected><?php echo str_repeat("&nbsp;&nbsp;",$v->level*3);?>{{$v->cate_name}}</option>
                    @else
                    <option value="{{$v->cate_id}}"><?php echo str_repeat("&nbsp;&nbsp;",$v->level*3);?>{{$v->cate_name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">分类编辑</button>
            &nbsp; &nbsp; &nbsp;
            <button type="button" class="btn btn-info">分类重置</button>
        </div>
    </div>
</form>

</body>

</html>
