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
    <title>Article----文章编辑</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/jquery-3.2.1.min.js"></script>
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

<form class="form-horizontal" role="form" action="{{url('article/update/'.$articleInfo->article_id)}}" method="post" enctype="multipart/form-data">
            <!---全局辅助函数-->
            @csrf

            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">文章标题:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="firstname"
                           name="article_title" value="{{$articleInfo->article_title}}" placeholder="请输入文章标题...">
                    <b style="color:red">{{$errors->first('article_title')}}</b>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">文章分类:</label>
                <div class="col-sm-2">
                    <select class="form-control" name="type_id">
                        <option>---请选择---</option>
                        @foreach($typeInfo as $v)
                            @if($articleInfo->type_id==$v->type_id)
                                <option value="{{$v->type_id}}" selected>{{$v->type_name}}</option>
                            @else
                                <option value="{{$v->type_id}}">{{$v->type_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">文章重要性:</label>
                <div class="col-sm-3">
                    <label class="radio-inline">
                        @if($articleInfo->article_importance==1)
                            <input type="radio" name="article_importance" value="1" checked>普通&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="article_importance" value="2"> 置顶
                        @else
                            <input type="radio" name="article_importance" value="1">普通&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="article_importance" value="2" checked> 置顶
                        @endif
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">是否显示:</label>
                <div class="col-sm-3">
                    <label class="radio-inline">
                        @if($articleInfo->article_importance==1)
                            <input type="radio" name="is_show" value="1" checked> 显示 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="is_show" value="2"> 不显示
                        @else
                            <input type="radio" name="is_show" value="1"> 显示 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="is_show" value="2" checked> 不显示
                        @endif
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">文章作者:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="lastname"
                           name="article_authors" value="{{$articleInfo->article_authors}}" placeholder="请输入文章作者...">
                    {{--<b style="color:red">{{$errors->first('brand_url')}}</b>--}}
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">作者Email:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="lastname"
                           name="authors_email" value="{{$articleInfo->authors_email}}" placeholder="请输入作者Email...">
                    {{--<b style="color:red">{{$errors->first('brand_url')}}</b>--}}
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">关键字:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="lastname"
                           name="keyword" value="{{$articleInfo->keyword}}" placeholder="请输入关键字...">
                    {{--<b style="color:red">{{$errors->first('brand_url')}}</b>--}}
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">网页描述:</label>
                <div class="col-sm-10">
                    <textarea name="web_desc" id="" cols="130" rows="5">{{$articleInfo->web_desc}}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">上传文件:</label>
                <div class="col-sm-3">
                    <img src="{{env('UPLOAD_URL')}}{{$articleInfo->files}}" width="70px">
                    <input type="file" class="form-control" id="lastname"
                           name="files">

                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">文章编辑</button>
                </div>
            </div>
</form>

</body>
</html>
