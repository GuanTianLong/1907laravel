@extends('layouts.shop')

@section('title', '前台用户注册')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="" method="post" class="reg-login">
         @csrf
      <h3>已经有账号了？点此<a class="orange" href="login.html">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" id="account" name="account" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" id="code" name="user_code" placeholder="输入短信验证码" /> <button type="button" id="sendCode"><span id="span_tel">获取验证码</span></button></div>
       <div class="lrList"><input type="text" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="text" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->

    @endsection

<script src="/jquery.js"></script>

<script>
    //页面加载
    $(document).ready(function(){
        $(document).on('click','#sendCode',function(){
            var account = $("#account").val();
            //console.log(account);
            var span_tel = $("#span_tel").text('60s');

            _a = setInterval(gotimes,1000);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(
                    "{{url('register/sendCode')}}",
                     {account:account},
                    function(res){
                            console.log(res);
                    }


            );


        });

        //秒数计时  获取60s -1 放回去  在html中得到的数据都是字符串
        function gotimes(){
            //获取当前纯文本60s字符串
            var second=$("#span_tel").text();
            //转化数值类型60
            secods=parseInt(second);
            if(secods>0){
                seconds=secods-1;
                $("#span_tel").text(seconds+'s');   //拼接s
                $("#span_tel").css('pointer-events','none');
            }else{
                clearInterval(_oo);
                $("#span_tel").text('获取');
                $("#span_tel").css("pointer-events","auto");
            }

        }












    });









</script>

