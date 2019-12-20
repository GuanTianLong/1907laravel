<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Goods;
class ProinfoController extends Controller
{
    /**商品详情*/
    public function proinfo($id){

        $where = [
            ['goods_id','=',$id]
        ];
        //查询商品数据----作为其产品详情页的展示
        $goodsInfo = Goods::where($where)->first();
        //商品相册处理
        $goodsInfo['goods_imgs'] = explode('|', $goodsInfo['goods_imgs']);

        //dd( $goodsInfo);
        return view('index.proinfo.proinfo',['goodsInfo'=>$goodsInfo]);
    }

}
