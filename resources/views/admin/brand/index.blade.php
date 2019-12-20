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
    <title>Brand----品牌列表</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>

<h2 style="color:darkviolet" align="center">品牌列表</h2>
<form action="" method="" align="center">

    <input type="text" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="请输入品牌名称...">
    <input type="text" name="brand_url"  value="{{$query['brand_url']??''}}"  placeholder="请输入品牌网址...">
    <button  class="btn btn-info">筛选</button>
</form><br>

<table class="table table-hover">
    {{--{{session('update')}}--}}
    <thead>
        <tr>
            <th>品牌ID</th>
            <th>品牌名称</th>
            <th>品牌网址</th>
            <th>品牌LOGO</th>
            <th>品牌详情</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if($data)
        @foreach($data as $v)
            <tr>
                <td>{{$v->brand_id}}</td>
                <td>{{$v->brand_name}}</td>
                <td>{{$v->brand_url}}</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" width="50px"></td>
                <td>{{$v->brand_desc}}</td>
                <td>
                    <a href="{{url('brand/destroy/'.$v->brand_id)}}"><button type="button" class="btn btn-danger">删除</button></a>
                    <a href="{{url('brand/edit/'.$v->brand_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
                </td>
            </tr>
        @endforeach
        @endif
    </tbody>
    <tr><td colspan="6">{{$data->appends($query)->links()}}</td><tr>
</table>


</body>
</html>

<h5 align="center"><a href="{{url('brand/create')}}">品牌添加</a></h5>

