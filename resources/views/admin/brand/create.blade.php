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
    <title>Brand----品牌添加</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

<form class="form-horizontal" role="form" action="{{url('brand/store')}}" method="post" enctype="multipart/form-data">
            <!---全局辅助函数-->
            @csrf

            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">品牌名称:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="firstname"
                           name="brand_name" placeholder="请输入品牌名称...">
                    <b style="color:red">{{$errors->first('brand_name')}}</b>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">品牌网址:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="lastname"
                           name="brand_url" placeholder="请输入品牌网址...">
                    <b style="color:red">{{$errors->first('brand_url')}}</b>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">品牌LOGO:</label>
                <div class="col-sm-3">
                    <input type="file" class="form-control" id="lastname"
                           name="brand_logo">
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">品牌详情:</label>
                <div class="col-sm-10">
                    <textarea name="brand_desc" id="" cols="130" rows="5"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">品牌添加</button>
                </div>
            </div>
</form>

</body>
</html>

<script src="/static/admin/jquery-3.2.1.min.js"></script>

<script>
        //页面加载
        $(function(){
            $('#firstname').blur(function(){
                checkName();
            });

            $('input[name="brand_url"]').blur(function(){
                checkUrl();
            });

            $('.btn-success').click(function(){
                //品牌名称
                var NameFlag = checkName();

                //品牌网址
                var UrlFlag = checkUrl();

                //提交
                if( NameFlag && UrlFlag ){
                    // alert(123);
                    $('.form-horizontal').submit();
                }
                return false;
            });

            function checkUrl(){
                        $('input[name="brand_url"]').next().text('');
                        var brand_url = $('input[name="brand_url"]').val();
                        var reg = /^http:\/\/+/;

                        if(!reg.test(brand_url)){
                            $('input[name="brand_url"]').next().text('品牌网址为http://开头');
                            return false;
                        }
                        return true;
                    }

            function checkName(){
                        $('#firstname').next().text('');
                        var brand_name = $('#firstname').val();
                        var reg = /^[\u4e00-\u9fa5\w]{2,12}$/;
                        if(!reg.test(brand_name)){
                            $('#firstname').next().text('品牌名称需是中文数字字母下划线组成长度为2-12位');
                            return false;
                        }
                        return checkOnly(brand_name);
                    }

            function checkOnly(brand_name){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var flag = true;
                //唯一性验证
                $.ajax({
                    method: "POST",
                    url: "{{url('brand/checkName')}}",
                    async:false,
                    data: { brand_name: brand_name }
                }).done(function( msg ) {
                    if(msg>0){
                        $('#firstname').next().text('品牌名称已存在');
                        flag = false;
                    }
                });
                return flag;
            }

        })

</script>
