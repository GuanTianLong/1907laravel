<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Category;

class Index extends Controller
{
    function index(){
        $goods_name = Request()->goods_name;
        //echo $goods_name;
        $where = [];

        if($goods_name){
                $where[]= ['goods_name','like',"%$goods_name%"];
        }

       //每页显示条数
       $page = config("app.pageSize");
       //查询商品表的所有数据
       $goodsInfo = Goods::where($where)->orderBy('goods_id','desc')->paginate($page);
       //查询所有的顶级分类
       $cateInfo = Category::where('parent_id','=',0)->get();
       $query = Request()->all();
       return view('index/index',['cateInfo'=>$cateInfo,'goodsInfo'=>$goodsInfo,'query'=>$query]);
    }
}
