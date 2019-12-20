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
    <title>Goods----商品编辑</title>
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

<form class="form-horizontal" role="form" action="{{url('goods/update/'.$goodsInfo->goods_id)}}" method="post" enctype="multipart/form-data">
            <!---全局辅助函数-->
            @csrf

            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">商品名称:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="firstname"
                           name="goods_name" value="{{$goodsInfo->goods_name}}" placeholder="商品名称">
                    {{--<b style="color:red">{{$errors->first('brand_name')}}</b>--}}
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品价格:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="lastname"
                           name="goods_price" value="{{$goodsInfo->goods_price}}" placeholder="商品价格">
                    {{--<b style="color:red">{{$errors->first('brand_url')}}</b>--}}
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">库存数量:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="lastname"
                           name="goods_num" value="{{$goodsInfo->goods_num}}" placeholder="库存数量">
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品积分:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="lastname"
                           name="goods_score" value="{{$goodsInfo->goods_score}}" placeholder="商品积分">
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品图片:</label>
                <div class="col-sm-3">
                    <img src="{{env('UPLOAD_URL')}}{{$goodsInfo->goods_img}}" width="50px">
                    <input type="file" class="form-control" id="lastname"
                           name="goods_img">
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品相册:</label>
                <div class="col-sm-3">
                    @foreach($goodsInfo->goods_imgs as $vv)
                        <img src="{{env('UPLOAD_URL')}}{{$vv}}" width="50px">
                    @endforeach
                    <input type="file" class="form-control" id="lastname"
                           name="goods_imgs[]" multiple>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">商品详情:</label>
                <div class="col-sm-10">
                    <textarea name="goods_desc" id="" cols="130" rows="5">{{$goodsInfo->goods_desc}}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">是否上架:</label>
                <div class="col-sm-3">
                    <label class="radio-inline">
                        @if($goodsInfo->is_up==1)
                            <input type="radio" name="is_up" value="1" checked> 是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="is_up" value="2"> 否
                        @else
                            <input type="radio" name="is_up" value="1"> 是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="is_up" value="2" checked> 否
                        @endif
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">是否新品:</label>
                <div class="col-sm-3">
                    <label class="radio-inline">
                        @if($goodsInfo->is_new==1)
                            <input type="radio" name="is_new" value="1" checked> 是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="is_new" value="2"> 否
                        @else
                            <input type="radio" name="is_new" value="1"> 是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="is_new" value="2" checked> 否
                        @endif
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">是否精品:</label>
                <div class="col-sm-3">
                    <label class="radio-inline">
                        @if($goodsInfo->is_best==1)
                            <input type="radio" name="is_best" value="1" checked> 是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="is_best" value="2"> 否
                         @else
                            <input type="radio" name="is_best" value="1"> 是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="is_best" value="2" checked> 否
                        @endif
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">是否热卖:</label>
                <div class="col-sm-3">
                    <label class="radio-inline">
                        @if($goodsInfo->is_hot==1)
                            <input type="radio" name="is_hot" value="1" checked> 是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="is_hot" value="2"> 否
                        @else
                            <input type="radio" name="is_hot" value="1"> 是 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="is_hot" value="2" checked> 否
                        @endif
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">品牌:</label>
                <div class="col-sm-2">
                    <select class="form-control" name="brand_id">
                            <option>---请选择---</option>
                        @foreach($brandInfo as $v)
                            @if($goodsInfo->brand_id==$v->brand_id)
                                <option value="{{$v->brand_id}}" selected>{{$v->brand_name}}</option>
                            @else
                                <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                            @endif
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
                            @if($goodsInfo->cate_id==$vv->cate_id)
                            <option value="{{$vv->cate_id}}" selected><?php echo str_repeat("&nbsp;&nbsp;",$vv->level*3);?>{{$vv->cate_name}}</option>
                            @else
                            <option value="{{$vv->cate_id}}"><?php echo str_repeat("&nbsp;&nbsp;",$vv->level*3);?>{{$vv->cate_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">商品编辑</button>
                </div>
            </div>
</form>

</body>
</html>
