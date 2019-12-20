@extends('layouts.shop')

@section('title', '购物车列表')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>购物车</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="/static/index/images/head.jpg" />
    </div><!--head-top/-->
    <table class="shoucangtab">
        <tr>
            <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
            <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
                <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
            </td>
        </tr>
    </table>

    <div class="dingdanlist">
        <table>
            <tr>
                <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" id="allBox"/> 全选</a></td>
            </tr>
            @foreach($carInfo as $v)
                <tr  goods_num="{{$v->goods_num}}" goods_id="{{$v->goods_id}}">
                    <td width="4%"><input type="checkbox" class="box"/></td>
                    <td class="dingimg" width="15%"><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}"></td>
                    <td width="50%">
                        <h3>{{$v->goods_name}}</h3>
                        <time>下单时间：{{date('Y-m-d H:i:s',$v->add_time)}}</time>
                    </td>
                    <td align="right">
                        <input type="button" class="less" value="-" style="width:30px;text-align:center;"/>
                        <input type="text" value="{{$v->buy_number}}" class="car_ipt buy_number" style="width:30px; color:#00ffff; text-align:center;"/>
                        <input type="button" class="add" value="+" style="width:30px;text-align:center;"/>
                    </td>
                    <td colspan="4" style="color:#ff4e00;">¥<span class="total">{{$v->goods_price*$v->buy_number}}</span></td>
                    <td><a class="del" style="white-space:nowrap">删除</a></td>
                </tr>
                {{--<tr>--}}
                    {{--<th colspan="4"><strong class="orange">¥{{$v->goods_price*$v->buy_number}}</strong></th>--}}
                {{--</tr>--}}
            @endforeach
            <tr>
                <td width="100%" colspan="4"><a href="javascript:;" style="color:red" id="delMany">删除</a></td>
            </tr>
        </table>
    </div><!--dingdanlist/-->

    <tr>
        <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
        <td width="50%">总计：<span class="orange" id="money">¥0</span></td>
        <td width="40%"><a href="javascript:;" class="jiesuan submit">去结算</a></td>
    </tr>

    </div><!--gwcpiao/-->
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

<!---引入jquery-->
<script src="./jquery.js"></script>

<script>
    //页面加载
    $(document).ready(function(){
        //点击+
        $(document).on("click",".add",function() {
            //当前点击的+
            var _this = $(this);
            var buy_number = parseInt(_this.prev("input").val());
            //console.log(buy_number);
            var goods_num = parseInt(_this.parents("tr").attr("goods_num"));
            //console.log(goods_num);
            var goods_id = _this.parents("tr").attr("goods_id");

            // 给文本框的购买数量+1
            if (buy_number >= goods_num) {
                _this.prev("input").val(goods_num);
            } else {
                //buy_number = buy_number+1;
                buy_number += 1;
                _this.prev("input").val(buy_number);
            }

            //给数据库的购买数量+1
            var res = changeBuyNumber(goods_id, buy_number, _this);
            if (res == 2) {
                return false;
            }
            //给当前行上的复选框选中状态
            changeChecked(_this);

            //重新获取小计
            getSubtotal(goods_id,_this);

            //重新获取总价	//获取所选中的复选框 所属的商品id
            getTotalprice();
        });

        //点击-
        $(document).on("click",".less",function() {
            //当前点击的-
            var _this = $(this);
            //console.log(_this)
            var buy_number = parseInt(_this.next("input").val());
            //console.log(buy_number);
            var goods_id = _this.parents("tr").attr("goods_id");

            // 给文本框的购买数量-1
            if (buy_number <= 1) {
                //文本框的值就为1
                _this.next("input").val(1);
            } else {
                //文本框的值就-1
                //buy_number = buy_number-1;
                buy_number -= 1;
                _this.next("input").val(buy_number);
            }

            //给数据库的购买数量-1
            var res = changeBuyNumber(goods_id, buy_number, _this);
            if (res == 2) {
                return false;
            }
            //给当前行上的复选框选中状态
            changeChecked(_this);

            //重新获取小计
            getSubtotal(goods_id,_this);

            //重新获取总价	//获取所选中的复选框 所属的商品id
            getTotalprice();

        });

        //失去焦点
        $(document).on("blur",".buy_number",function() {
            //alert(1)
            //当前失去焦点的文本框
            var _this = $(this);
            var goods_id = _this.parents("tr").attr("goods_id");
            var buy_number = parseInt(_this.val());
            var goods_num = parseInt(_this.parents("tr").attr("goods_num"));

            var reg = /^\d{1,}$/;
            //判断文本框的值是否为数字
            if(!reg.test(buy_number)||buy_number<=1){
                _this.val(1);
                // buy_number = 1;
            }else if(buy_number>=goods_num) {
                _this.val(goods_num);
                buy_number = goods_num;
            }else{
                _this.val(buy_number);
            }

            //给数据库的购买数量 改为文本框的购买数量
            var res = changeBuyNumber(goods_id, buy_number, _this);
            if (res == 2) {
                return false;
            }
            //给当前行上的复选框选中状态
            changeChecked(_this);

            //重新获取小计
            getSubtotal(goods_id,_this);

            //重新获取总价	//获取所选中的复选框 所属的商品id
            getTotalprice();

        });

        //点击复选框
        $(document).on("click",".box",function(){
            //当前点击的复选框
            var _this = $(this);
            //console.log(_this);
            // 给当前行上的复选框选中状态
            var status=$(this).prop('checked');

            var goods_id = _this.parents("tr").attr("goods_id");
            if (status == true) {
                changeChecked(_this);
            } else {
                _this.parents("tr").removeClass('car_tr');
            }

            //重新获取小计
            getSubtotal(goods_id,_this);

            //重新获取总价	//获取所选中的复选框 所属的商品id
            getTotalprice();
        });

        //点击全选
        $(document).on("click", "#allBox", function () {
            var status = $("#allBox").prop("checked");
            if (status == true) {
                $("tr[goods_id]").addClass('car_tr');
            } else {
                $("tr[goods_id]").removeClass('car_tr');
            }
            $(".box").prop("checked", status);
            //获取总价
            getTotalprice();
        });

        // 点击删除
        $(document).on("click",".del",function(){
            //当前点击的删除的超链接
            var _this=$(this);
            //获取商品id
            var goods_id=_this.parents('tr').attr('goods_id')+',';
            //console.log(goods_id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //通过ajax技术传给控制器 进行删除
            $.post(

                "{{url('/getDel')}}",
                {goods_id:goods_id},
                function(res) {
                    if(res=='OK'){
                        _this.parents('tr').remove();
                    }else{
                        alert('删除失败');
                    }

//                        if(res.code==1){
//                            //删除成功 移除掉当前行
//                            _this.parents('tr').remove();
//                        }else{
//                            alert(res.font);
//                        }
//                    },
//                    'json'

                    console.log(res);
                }
            );
        });

        //点击批量删除
        $(document).on("click","#delMany",function() {
            //获取选中的复选框所属的商品id
            var _box = $(".box:checked");
            //console.log(_box);
            var goods_id = '';
            _box.each(function (index) {
                goods_id += $(this).parents("tr").attr("goods_id") + ',';
            });
            goods_id = goods_id.substr(0, goods_id.length - 1);   //对象.属性    对象.方法()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //通过ajax技术传给控制器 进行批量删除
            $.post(
                "{{url('/getDel')}}",
                {goods_id:goods_id},
                function (res) {
                    console.log(res)
                    if(res=='OK'){
                        //删除成功 移除掉当前
                        _box.each(function(res){
                            //删除成功 移除掉当前行
                            $(this).parents('tr').remove();
                        });
                    }else{
                        alert('删除失败');
                  }
                });

        });

        //点击去结算
        $(document).on("click",".submit",function(){
            //获取选中的复选框 所属于的商品id
            var _box=$(".box:checked");
            //console.log(_box);
            if(_box.length>0){
                var goods_id="";
                _box.each(function(index){
                    goods_id+=$(this).parents('tr').attr('goods_id')+',';
                });

                goods_id = goods_id.substr(0,goods_id.length-1);

                location.href="/confirmpay/?goods_id="+goods_id;
            }else{

                alert("至少选择一件商品进行结算");
            }

        });

        //修改购买数量
        function changeBuyNumber(goods_id, buy_number, _this) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var flag = 1;
            $.ajax({
                method: "POST",
                url: "{{url('/changeBuyNumber')}}",
                data: {goods_id: goods_id, buy_number: buy_number},
                async: false
            }).done(function (res) {
                //console.log(res);
                if (res == "no") {	//修改失败的值变为当前的 值
                    alert("修改失败");
                    _this.prev("input").val(goods_num - 1);
                    flag = 2;
                }
            });
            return flag;
        };

        //复选框选中状态
        function changeChecked(_this) {
            _this.parents("tr").find(".box").prop("checked", true);
        };

        //获取小计
        function  getSubtotal(goods_id,_this){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                "{{url('/getSubtotal')}}",
                {goods_id:goods_id},
                function(res){
                    _this.parents("tr").find(".total").text(res);
                }
            );
        }

        //获取总价
        function  getTotalprice(){
            var goods_id="";
            var _box=$(".box:checked");
            _box.each(function(index){
                goods_id+=$(this).parents("tr").attr('goods_id')+',';
            });
            goods_id=goods_id.substr(0,goods_id.length-1);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                "{{url('/getTotalprice')}}",
                {goods_id:goods_id},
                function(res){
                    console.log(res);
                    $("#money").text("￥"+res);
                }
            );
        }


    });


</script>