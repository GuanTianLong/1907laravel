@extends('layouts.shop')

@section('title', '前台首页')

@section('content')
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
      <dl>
       <dt><a href="user.html"><img src="/static/index/images/touxiang.jpg" /></a></dt>
       <dd>
        <h1 class="username">三级分销终身荣誉会员</h1>
        <ul>
         <li><a href="prolist/prolist.blade.php"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="" method="get" class="search">
      <input type="text" class="seaText fl" name="goods_name" placeholder="请输入商品名称..."/>
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
      <li><a href="{{url('/login')}}">登录</a></li>
      <li><a href="{{url('/register')}}" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
         <img src="/static/index/images/image1.jpg" />
         <img src="/static/index/images/image2.jpg" />
         <img src="/static/index/images/image3.jpg" />
         <img src="/static/index/images/image4.jpg" />
         <img src="/static/index/images/image5.jpg" />
     </div><!--sliderA/-->
     <ul class="pronav">
         <!---所有的顶级分类--->
         @foreach($cateInfo as $v)
              <li><a href="{{url('/prolist/'.$v->cate_id)}}">{{$v->cate_name}}</a></li>
         @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->

     <div class="index-pro1">
         <!---首页所有商品的展示--->
      @foreach($goodsInfo as $val)
         <div class="index-pro1-list">
          <dl>
           <dt><a href="{{url('/proinfo/'.$val->goods_id)}}"><img src="{{env('UPLOAD_URL')}}{{$val->goods_img}}" width="200px" height="300px"></a></dt>
           <dd class="ip-text"><a href="{{url('/proinfo/'.$val->goods_id)}}">{{$val->goods_name}}</a><span>已售：488</span></dd>
           <dd class="ip-price"><strong>¥299</strong> <span>¥{{$val->goods_price}}</span></dd>
          </dl>
         </div>
      @endforeach

      <div class="clearfix"></div>
      </div><!--index-pro1/-->

     <!--显示分页页码---->
     {{ $goodsInfo->links()}}

     @foreach($goodsInfo as $v)
         <div class="prolist">
          <dl>
           <dt><a href="{{url('/proinfo/'.$v->goods_id)}}"><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}"></a></dt>
           <dd>
            <h3><a href="proinfo.html">{{$v->goods_name}}</a></h3>
            <div class="prolist-price"><strong>¥299</strong> <span>¥{{$v->goods_price}}</span></div>
            <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
           </dd>
           <div class="clearfix"></div>
          </dl>
         </div><!--prolist/-->
     @endforeach

     <div class="joins"><a href="fenxiao.html"><img src="/static/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>

@endsection
