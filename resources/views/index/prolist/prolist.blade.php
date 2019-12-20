@extends('layouts.shop')

@section('title', '商品展示')

@section('content')

    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <form action="#" method="get" class="prosearch"><input type="text" /></form>
        </div>
    </header>

    <ul class="pro-select">
        <li class="pro-selCur"><a href="javascript:;" class="add">新品</a></li>
        <li><a href="javascript:;" class="add">销量</a></li>
        <li><a href="javascript:;" class="add">价格</a></li>
    </ul><!--pro-select/-->

     <div class="prolist">
      @foreach($goodsInfo as $v)
             <dl>
                 <dt><a href="proinfo.html"><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="100px" height="100px"></a></dt>
                 <dd>
                     <h3><a href="proinfo.html">{{$v->goods_name}}</a></h3>
                     <div class="prolist-price"><strong>{{$v->goods_price}}</strong> <span>¥599</span></div>
                     <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
                 </dd>
                 <div class="clearfix"></div>
             </dl>
       @endforeach

     </div><!--prolist/-->

@endsection

    <!----引入jquery--->
<!-----
    <script src="/jquery.js"></script>

     <script>
         //页面加载
         $(function(){
                 $(document).on('click','.add',function(){
                     //当前点击的新品
                     var _this = $(this);

                     _this.parent("li").addClass("pro-selCur").sibling().removeClass("pro-selCur")

                 })


         })


    </script>
--->