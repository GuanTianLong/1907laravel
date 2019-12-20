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
    <title>Brand----品牌编辑</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body bgcolor="#da70d6">

<form class="form-horizontal" role="form" action="{{url('brand/update/'.$data->brand_id)}}" method="post" enctype="multipart/form-data">
    <!---全局辅助函数-->
    @csrf

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="firstname"
                   name="brand_name" value="{{$data->brand_name}}" placeholder="请输入品牌名称...">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌网址:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="lastname"
                   name="brand_url" value="{{$data->brand_url}}" placeholder="请输入品牌网址...">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌LOGO:</label>
        <td><img src="{{env('UPLOAD_URL')}}{{$data->brand_logo}}" width="50px"></td>
        <div class="col-sm-3">
            <input type="file" class="form-control" id="lastname"
                   name="brand_logo">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌详情:</label>
        <div class="col-sm-10">
            <textarea name="brand_desc" id="" cols="130" rows="5">{{$data->brand_desc}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">品牌编辑</button>
        </div>
    </div>
</form>

</body>
</html>
