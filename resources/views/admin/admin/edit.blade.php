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
    <title>Admin----管理员编辑</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>

<!---显示验证错误信息-->
{{--@if ($errors->any())--}}
    {{--<div class="alert alert-danger">--}}
        {{--<ul>--}}
            {{--@foreach ($errors->all() as $error)--}}
                {{--<li>{{ $error }}</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--@endif--}}

<form class="form-horizontal" role="form" action="{{url('admin/update/'.$adminInfo->admin_id)}}" method="post" enctype="multipart/form-data">
            <!---全局辅助函数-->
            @csrf

            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">账号:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="firstname"
                           name="account" value="{{$adminInfo->account}}" placeholder="请输入账号...">
                    {{--<b style="color:red">{{$errors->first('brand_name')}}</b>--}}
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">密码:</label>
                <div class="col-sm-3">
                    <input type="password" class="form-control" id="lastname"
                           name="pwd" value="{{$adminInfo->pwd}}" placeholder="请输入密码...">
                    {{--<b style="color:red">{{$errors->first('brand_url')}}</b>--}}
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">头像:</label>
                <div class="col-sm-3">
                    <input type="file" class="form-control" id="lastname"
                           name="admin_photo">
                    <img src="{{env('UPLOAD_URL')}}{{$adminInfo->admin_photo}}" width="50px">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">管理员编辑</button>
                </div>
            </div>
</form>

</body>
</html>
