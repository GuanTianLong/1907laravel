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
    <title>Goods----商品列表</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>

<h2 style="color:darkviolet" align="center">商品列表</h2>
<form action="" method="" align="center">

    商品名称:<input type="text" name="goods_name" placeholder="请输入商品名称">
    品牌:
        <select class="" name="brand_id">
            <option>---请选择---</option>
            @foreach($brandInfo as $v)
                <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
            @endforeach
        </select>


    <button  class="btn btn-info">筛选</button>

</form><br>

<table class="table table-hover">
    {{--{{session('update')}}--}}
    <thead>
        <tr>
            <th>商品ID</th>
            <th>商品名称</th>
            <th>商品价格</th>
            <th>商品库存</th>
            <th>商品图片</th>
            <th>商品相册</th>
            <th>商品详情</th>
            <th>是否上架</th>
            <th>是否新品</th>
            <th>是否精品</th>
            <th>是否热卖</th>
            <th>商品积分</th>
            <th>品牌类型</th>
            <th>分类类型</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @if($goodsInfo)
        @foreach($goodsInfo as $v)
            <tr>
                <td>{{$v->goods_id}}</td>
                <td>{{$v->goods_name}}</td>
                <td>{{$v->goods_price}}</td>
                <td>{{$v->goods_num}}</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="50px"></td>
                <td>
                    @foreach($v->goods_imgs as $vv)
                        <img src="{{env('UPLOAD_URL')}}{{$vv}}" width="50px">
                    @endforeach
                </td>
                <td>{{$v->goods_desc}}</td>
                <td>@if($v->is_up==1)<b style="color:springgreen">√</b>@else<b style="color:red">×</b>@endif</td>
                <td>@if($v->is_new==1)<b style="color:springgreen">√</b>@else<b style="color:red">×</b>@endif</td>
                <td>@if($v->is_best==1)<b style="color:springgreen">√</b>@else<b style="color:red">×</b>@endif</td>
                <td>@if($v->is_hot==1)<b style="color:springgreen">√</b>@else<b style="color:red">×</b>@endif</td>
                <td>{{$v->goods_score}}</td>
                <td>{{$v->brand_name}}</td>
                <td>{{$v->cate_name}}</td>
                <td>
                    <a href="{{url('goods/destroy/'.$v->goods_id)}}"><button type="button" class="btn btn-danger">删除</button></a>
                    <a href="{{url('goods/edit/'.$v->goods_id)}}"><button type="button" class="btn btn-info">编辑</button></a>
                </td>
            </tr>
        @endforeach
        @endif
    </tbody>
   {{-- <tr><td colspan="6">{{$adminInfo->appends($query)->links()}}</td><tr>--}}
</table>


</body>
</html>

<h5 align="center"><a href="{{url('goods/create')}}">商品添加</a></h5>

