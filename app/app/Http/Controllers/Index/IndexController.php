<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;

class IndexController extends Controller
{
        //前台首页
        public function index(){

            $goodsInfo = Goods::get();

            //dd($goodsInfo);

            return view('index.index',['goodsInfo'=>$goodsInfo]);
        }

}
