@extends('layouts.shop')

@section('title', '收货地址添加')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>收货地址</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="/static/index/images/head.jpg" />
    </div><!--head-top/-->
    <form action="login.html" method="get" class="reg-login">
        @csrf
        <div class="lrBox">
            <div class="lrList"><input type="text" placeholder="收货人" name="consignee"/></div>
            <div class="lrList"><input type="text" placeholder="详细地址" name="detail_address"/></div>

                <select class="change" name="province">
                    <option>省份/直辖市</option>
                    @foreach($provinceInfo as $v)
                        <option value="{{$v->area_id}}">{{$v->area_name}}</option>
                    @endforeach
                </select>


                <select class="change" name="city">
                    <option value="0" selected>市</option>
                </select>


                <select class="change" name="area">
                    <option value="0" selected>县/区</option>
                </select>

            <div class="lrList"><input type="text" placeholder="手机号" name="tel"/></div>
            <div class="lrList2">
            div
                <select name="is_default">
                    <option value="1" selected>默认</option>
                    <option value="2">不默认</option>
                </select>

            </div>
        </div><!--lrBox/-->
        <div class="lrSub">
            <input type="submit" value="保存" />
        </div>
    </form><!--reg-login/-->

    <div class="height1"></div>
    <div class="footNav">
        <dl>
            <a href="index.html">
                <dt><span class="glyphicon glyphicon-home"></span></dt>
                <dd>微店</dd>
            </a>
        </dl>
        <dl>
            <a href="prolist.html">
                <dt><span class="glyphicon glyphicon-th"></span></dt>
                <dd>所有商品</dd>
            </a>
        </dl>
        <dl>
            <a href="car.html">
                <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
                <dd>购物车 </dd>
            </a>
        </dl>
        <dl class="ftnavCur">
            <a href="user.html">
                <dt><span class="glyphicon glyphicon-user"></span></dt>
                <dd>我的</dd>
            </a>
        </dl>
        <div class="clearfix"></div>
    </div><!--footNav/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('/static/index/js/jquery.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('/static/index/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/static/index/js/style.js')}}"></script>
    <!--jq加减-->
    <script src="{{asset('/static/index/js/jquery.spinner.js')}}"></script>
    <script>
        $('.spinnerExample').spinner({})
    </script>
    </body>
    </html>

@endsection


<script type="text/javascript" src="./jquery.js"></script>

<script type="text/javascript">
    $(function(){
        //下拉菜单的选取
        $(document).on('change','.change',function(){
            var _this=$(this);  //表示当前要发生内容改变的下拉菜单
            //alert(111);
            _this.nextAll('select').html("<option value=''>--请选择--</option>");
            var area_id=_this.val();
            //console.log(area_id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                method:"POST",
                url:"{{url('/getplace')}}/"+area_id,
                dataType:'json',
            }).done(function(res){
                //console.log(res);
                var _option="<option value=''>--请选择--</option>";
                for(var i in res){
                    _option+="<option value='"+res[i]['area_id']+"'>"+res[i]['area_name']+"</option>"
                }
                //console.log(_option);
                _this.next('select').html(_option);
            })

        })
    })
</script>