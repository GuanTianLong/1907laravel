<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Car;

class ConfirmpayController extends Controller
{
    /**确认结算*/
    public function confirmpay(){

        $goods_id = request()->goods_id;
        $goods_id = explode(',',$goods_id);
        //print_r($goods_id);die;


        $goodsInfo = Goods::leftjoin('car','goods.goods_id','=','car.goods_id')
                            ->where('car_del','=',1)
                            ->whereIn('goods.goods_id',$goods_id)
                            ->get();

        //dd($goodsInfo);
        $totalPrice = 0;
        //获取总价
        foreach($goodsInfo as $k=>$v){

            $totalPrice+=$v['goods_price']*$v['buy_number'];
            //$count = $count + $v['goods_price']*$v['buy_number'];
        }

        return view('index.confirmpay.confirmpay',['goodsInfo'=>$goodsInfo,'totalPrice'=>$totalPrice]);
    }
}
