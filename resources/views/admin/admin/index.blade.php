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
    <title>Admin----管理员列表</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>

<h2 style="color:darkviolet" align="center">管理员列表</h2>
<form action="" method="" align="center">

    <input type="text" name="account" value="{{$query['account']??''}}" placeholder="请输入账号...">
    <button  class="btn btn-info">筛选</button>

</form><br>

<table class="table table-hover">
    {{--{{session('update')}}--}}
    <thead>
        <tr>
            <th>管理员ID</th>
            <th>账号</th>
            <th>头像</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if($adminInfo)
        @foreach($adminInfo as $v)
            <tr>
                <td>{{$v->admin_id}}</td>
                <td>{{$v->account}}</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->admin_photo}}" width="50px"></td>
                <td>
                    <a href="{{url('admin/destroy/'.$v->admin_id)}}"><button type="button" class="btn btn-danger">删除</button></a>
                    <a href="{{url('admin/edit/'.$v->admin_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
                </td>
            </tr>
        @endforeach
        @endif
    </tbody>
    <tr><td colspan="6">{{$adminInfo->appends($query)->links()}}</td><tr>
</table>


</body>
</html>

<h5 align="center"><a href="{{url('admin/create')}}">管理员添加</a></h5>

