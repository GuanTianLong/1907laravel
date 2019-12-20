<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Login extends Controller
{
    //登录视图
    public function login(){

        return view('index.login');
    }

    //执行登录
    public function loginDo(Request $request){
        //接收表单全部值
        $post = $request->all();
        //接收表单全部值
        // $post = $request->input();
        //接收表单单值
        //$post = $request->account;

        dd($post);

    }

    //路由参数----必选参数
    public function lists($id,$name){

        echo $id;
        echo $name;
    }

    //路由参数----可选参数
    public function gets($id,$name="Jeson"){

        echo $id."<br>";
        echo $name;

    }

    //全局约束
    public function test($id,$name){

        echo $id;

        echo $name;

    }

}
