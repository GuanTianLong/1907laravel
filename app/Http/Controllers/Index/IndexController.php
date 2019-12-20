<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Category;

class IndexController extends Controller
{
    function index(){
        $goodsInfo = Goods::get();
        $cateInfo = Category::where('parent_id','=',0)->get();
        return view('index/index',['cateInfo'=>$cateInfo,'goodsInfo'=>$goodsInfo]);
    }
}
