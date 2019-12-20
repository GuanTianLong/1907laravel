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
    <title>Goods----商品添加</title>
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

<form class="form-horizontal" role="form" action="{{url('goods/store')}}" method="post" enctype="multipart/form-data">
            <!---全局辅助函数-->
            @csrf

            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">商品名称:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="firstname"
                           name="goods_name" placeholder="商品名称">
                    {{--<b style="color:red">{{$errors->first('brand_name')}}</b>--}}
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品价格:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="lastname"
                           name="goods_price" placeholder="商品价格">
                    {{--<b style="color:red">{{$errors->first('brand_url')}}</b>--}}
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">库存数量:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="lastname"
                           name="goods_num" placeholder="库存数量">
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品积分:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="lastname"
                           name="goods_score" placeholder="商品积分">
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品图片:</label>
                <div class="col-sm-3">
                    <input type="file" class="form-control" id="lastname"
                           name="goods_img">
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品相册:</label>
                <div class="col-sm-3">
                    <input type="file" class="form-control" id="lastname"
                           name="goods_imgs[]" multiple>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品详情:</label>
                <div class="col-sm-10">
                    <textarea name="goods_desc" id="" cols="130" rows="5"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">是否上架:</label>
                <div class="col-sm-3">
                    <label class="radio-inline">
                        <input type="radio" name="is_up" value="1" checked> 是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="is_up" value="2"> 否
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">是否新品:</label>
                <div class="col-sm-3">
                    <label class="radio-inline">
                        <input type="radio" name="is_new" value="1" checked> 是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="is_new" value="2"> 否
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">是否精品:</label>
                <div class="col-sm-3">
                    <label class="radio-inline">
                        <input type="radio" name="is_best" value="1" checked> 是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="is_best" value="2"> 否
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">是否热卖:</label>
                <div class="col-sm-3">
                    <label class="radio-inline">
                        <input type="radio" name="is_hot" value="1" checked> 是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="is_hot" value="2"> 否
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">品牌:</label>
                <div class="col-sm-2">
                    <select class="form-control" name="brand_id">
                            <option>---请选择---</option>
                        @foreach($brandInfo as $v)
                            <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">分类:</label>
                <div class="col-sm-2">
                    <select class="form-control" name="cate_id">
                            <option>---请选择---</option>
                        @foreach($cateInfo as $vv)
                            <option value="{{$vv->cate_id}}"><?php echo str_repeat("&nbsp;&nbsp;",$vv->level*3);?>{{$vv->cate_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">商品添加</button>
                </div>
            </div>
</form>

</body>
</html>
