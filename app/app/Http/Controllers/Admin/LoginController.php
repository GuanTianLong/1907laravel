<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *登录视图
     * @return \Illuminate\Http\Response
     */
    public function login()
    {

        return view('admin.login.login');
    }

    /**
     * Show the form for creating a new resource.
     *执行登录
     * @return \Illuminate\Http\Response
     */
//    public function loginDo()
//    {
//
//       /* $validatedData = Request()->validate([
//            'account' => 'required|unique:posts|max:15|min:5',
//            'pwd' => 'required|confirmed',
//        ],[
//            'account.required'=>'账号必填',
//            'account.unqiue'=>'账号已存在',
//            'account.max'=>'账号最大长度15位',
//            'account.min'=>'账号最小长度5位',
//            'pwd'=>'密码必填',
//        ]);*/
//
//
//        $account = Request()->account;
//        $pwd = Request()->pwd;
//
//        $where = [
//
//            ['account','=',$account],
//            ['pwd','=',$pwd]
//        ];
//
//        $adminInfo = Admin::where($where)->first();
//
//        if($adminInfo){
//                session(['account'=>$account]);  //设置
//                request()->session()->save();   //存储到服务器
//                echo "<script>alert('登录成功');location.href='/admin/indexs/'</script>";
//            }else{
//                echo "<script>alert('账号或密码有误')</script>";
//            }
//        }

    public function loginDo(){

        $post = request()->except('_token');

        //dd($post);
        if (Auth::attempt($post)) {
            // 认证通过...
            //获取用户信息
            $user = Auth::user();
            //dd($user);

            //获取用户id
            $user_id = Auth::id();
            //dd($user_id);

//            return redirect()->intended('/brand');
              return redirect('/admin/indexs');
        }else{
              return redirect('/login')->with('msg','账号或密码错误');
        }


    }


}
