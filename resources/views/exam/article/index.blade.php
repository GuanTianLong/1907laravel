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
    <title>Article----文章列表</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/jquery-3.2.1.min.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>

<h2 style="color:darkviolet" align="center">文章列表</h2>
<form action="" method="get" align="center">

                文章标题:
                        <input type="text" name="article_title" value="{{$query['article_title']??''}}" placeholder="请输入文章标题...">

                        <select name="type_id">
                            <option value="">---请选择---</option>
                            @foreach($typeInfo as $v)
                                <option value="{{$v->type_id}}" {{$v->type_id==request()->type_id ? 'selected':''}}>{{$v->type_name}}</option>
                            @endforeach
                        </select>
    <button  class="btn btn-info">搜索</button>
</form><br>

<table class="table table-hover">
    {{--{{session('update')}}--}}
    <thead>
        <tr>
            <th>编号</th>
            <th>文章标题</th>
            <th>文章分类</th>
            <th>文章重要性</th>
            <th>是否显示</th>
            <th>文章作者</th>
            <th>网页描述</th>
            <th>上传文件</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if($articleInfo)
        @foreach($articleInfo as $v)
            <tr article_id = "{{$v->article_id}}">
                <td>{{$v->article_id}}</td>
                <td>{{$v->article_title}}</td>
                <td>{{$v->type_name}}</td>
                <td>
                    @if($v->article_importance==1)<b style="color:springgreen">普通</b>@else<b style="color:red">置顶</b>@endif

                </td>
                <td>
                    @if($v->is_show==1)<b style="color:springgreen">√</b>@else<b style="color:red">×</b>@endif
                </td>
                <td>{{$v->article_authors}}</td>
                <td>{{$v->web_desc}}</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->files}}" width="50px"></td>
                <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
                <td>
                    <a href="{{url('article/destroy/'.$v->article_id)}}"><button type="button" class="btn btn-danger">删除</button></a>
                    <a href="{{url('article/edit/'.$v->article_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
                </td>
            </tr>
        @endforeach
        @endif
    </tbody>
    <tr><td colspan="6">{{$articleInfo->appends($query)->links()}}</td><tr>
</table>


</body>
</html>

<h5 align="center"><a href="{{url('article/create')}}">文章添加</a></h5>


<script src="/static/admin/jquery-3.2.1.min.js"></script>
<script>
    //页面加载
   $(function(){
       $(document).on('click','.btn-danger',function() {
           if (window.confirm('您确定要删除吗123?')) {
               {{--var _this = $(this);--}}
               {{--var article_id = _this.parents('tr').attr('article_id');--}}
{{--//               $.ajaxSetup({--}}
{{--//                   headers: {--}}
{{--//                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--//                   }--}}
{{--//               });--}}
               {{--$.post(--}}
                   {{--"{{url('article/destroy')}}",--}}
                   {{--{article_id:article_id},--}}
                   {{--function (res) {--}}
                       {{--if(res=='ok'){--}}
                           {{--_this.parents('tr').remove();--}}
                       {{--}else{--}}
                           {{--alert('删除失败');--}}
                       {{--}--}}
                   {{--}--}}
               {{--)--}}
           }
       })

   })

</script>

