@extends('layouts.shop')

@section('title', '商品详情')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>商品详情</h1>
        </div>
    </header>
    <div id="sliderA" class="slider">
        @foreach($goodsInfo->goods_imgs as $v)
            <img src="{{env('UPLOAD_URL')}}{{$v}}">
        @endforeach
    </div><!--sliderA/-->
    <table class="jia-len">
        <tr>
            <th><strong class="orange">{{$goodsInfo->goods_price}}</strong></th>
            <td>
                <div>
                    <input type="button" id="less" value="-" style="width:30px">

                    <input value="1" id="buy_number" type="text" size="15" style="text-align:center;color:paleturquoise;vertical-align:middel;width:50px;height:27px;"/>

                    <input type="button" id="add" value="+" style="width:30px">
                </div>
                {{--<input type="text" class="spinnerExample" maxlength="2">--}}
            </td>
        </tr>
        <tr>
            <td>
                <strong>{{$goodsInfo->goods_name}}</strong><br>
                库存:<strong id="goods_num">{{$goodsInfo->goods_num}}</strong>
                <p class="hui">{{$goodsInfo->desc}}</p>
            </td>
            <td align="right">
                <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
            </td>
        </tr>
    </table>
    <div class="height2"></div>
    <h3 class="proTitle">商品规格</h3>
    <ul class="guige">
        <li class="guigeCur"><a href="javascript:;">50ML</a></li>
        <li><a href="javascript:;">100ML</a></li>
        <li><a href="javascript:;">150ML</a></li>
        <li><a href="javascript:;">200ML</a></li>
        <li><a href="javascript:;">300ML</a></li>
        <div class="clearfix"></div>
    </ul><!--guige/-->
    <div class="height2"></div>
    <div class="zhaieq">
        <a href="javascript:;" class="zhaiCur">商品简介</a>
        <a href="javascript:;">商品参数</a>
        <a href="javascript:;" style="background:none;">订购列表</a>
        <div class="clearfix"></div>
    </div><!--zhaieq/-->
    <div class="proinfoList">
        <img src="{{env('UPLOAD_URL')}}{{$goodsInfo->goods_img}}">
    </div><!--proinfoList/-->
    <div class="proinfoList">
        暂无信息....
    </div><!--proinfoList/-->
    <div class="proinfoList">
        暂无信息......
    </div><!--proinfoList/-->
    <table class="jrgwc">
        <tr>
            <th>
                <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
            </th>
            <td><a href="javascript:;" id="addCar">加入购物车</a></td>
        </tr>
    </table>
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('/static/index/js/jquery.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('/static/index/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/static/index/js/style.js')}}"></script>
    <!--jq加减-->
    <script src="{{asset('/static/index/js/jquery.spinner.js')}}"></script>
    <script>
        $('.spinnerExample').spinner({});
    </script>
    </body>
    </html>

@endsection

<!------引入jquery--->
<script src="/jquery.js"></script>

<script>
    $(document).ready(function(){
        //点击+
        $(document).on("click","#add",function(){
            //获取文本框的值
            var buy_number = parseInt($("#buy_number").val());
            //获取商品的库存
            var goods_num = parseInt($("#goods_num").text());
            //console.log(buy_number);
            //console.log(goods_num);
            if(buy_number>=goods_num){
                $("#buy_number").val(goods_num);
            }else{
                //buy_number = buy_number+1;
                buy_number+=1;
                $("#buy_number").val(buy_number);
            }
        });

        //点击-
        $(document).on("click","#less",function(){
            //获取文本框的值
            var buy_number = $("#buy_number").val();
            //console.log(buy_number);
            if(buy_number<=1){
                $("#buy_number").val(1);
            }else{
                //buy_number = buy_number-1;
                buy_number-=1;
                $("#buy_number").val(buy_number);
            }
        });

        //失去焦点
        $(document).on("blur","#buy_number",function(){
            //获取文本框的值
            var buy_number = parseInt($("#buy_number").val());
            //console.log(buy_number);
            //获取商品的库存
            var goods_num = parseInt($("#goods_num").text());
            console.log(goods_num);
            //验证
            var reg=/^\d{1,}$/;
            //判断文本框的值是否为数字
            if(!reg.test(buy_number)||buy_number<=1){
                $("#buy_number").val(1);
            }else if(buy_number>=goods_num){
                $("#buy_number").val(goods_num);
            }else{
                $("#buy_number").val(buy_number);
            }

        });

        //点击加入购物车
        $(document).on("click","#addCar",function(){
            //获取购买数量
            var buy_number = $("#buy_number").val();
            //获取商品的id
            var goods_id = "{{$goodsInfo->goods_id}}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //通过ajax技术传给控制器
            $.ajax({
                method: "POST",
                url: "{{url('/addCar')}}",
                data: {buy_number:buy_number,goods_id:goods_id},
                // async:false
            }).done(function( msg ) {
               if(msg==1){
                   alert('加入购物车成功');location.href='/carlist';
               }else{
                   alert('加入购物车失败');
               }
            });



        })

    })

</script>