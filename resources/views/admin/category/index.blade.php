<?php
/**
 * Created by PhpStorm.
 * User: win10
 * Date: 2019/12/5
 * Time: 11:16
 */

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Category----分类列表</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>

<h3 style="color:#f99b15" align="center">分类列表</h3>

<table class="table table-hover">
    {{--{{session('update')}}--}}
    <thead>
        <tr>
            <th>ID</th>
            <th>分类名称</th>
            <th>是否显示</th>
            <th>是否导航栏显示</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if($cateInfo)
        @foreach($cateInfo as $v)
            <tr>
                <td>{{$v->cate_id}}</td>
                <td>{{$v->cate_name}}</td>
                <td>@if($v->cate_show==1)<b style="color:mediumspringgreen">√</b>@else<b style="color:red">×</b>@endif</td>
                <td>@if($v->cate_nav_show==1)<b style="color:mediumspringgreen">√</b>@else<b style="color:red">×</b>@endif</td>
                <td>
                    <a href="{{url('category/destroy/'.$v->cate_id)}}"><button type="button" class="btn btn-danger">删除</button></a>
                    <a href="{{url('category/edit/'.$v->cate_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
                </td>
            </tr>
        @endforeach
        @endif
    </tbody>
</table>


</body>
</html>

<h5 align="center"><a href="{{url('category/create')}}">分类添加</a></h5>

