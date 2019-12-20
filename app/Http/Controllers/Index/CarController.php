<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Car;
use App\Model\Goods;

class CarController extends Controller
{
    /**点击加入购物车*/
    public function addCar(){
        //接收购买数量
        $buy_number = Request()->buy_number;
        //echo $buy_number;
        //接收商品id
        $goods_id = Request()->goods_id;
        //echo $goods_id;

        $data =  [
            'buy_number'=> $buy_number,
            'goods_id'=> $goods_id,
            'add_time'=> time()
        ];
        //dump($data);
        $where = [
            ['car_del','=',1],
            ['goods_id','=',$goods_id]
        ];
        $res = Car::where($where)->first();
        if($res){
            $data = Car::where('goods_id','=',$goods_id)->update(['buy_number'=>$res['buy_number']+$buy_number,'add_time'=>time()]);
            if($data){
                echo 1;
            }else{
                echo 2;
            }
        }else{
            //入库
            $res = Car::create($data);
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }

    }

    //购物车列表
    public function carlist(){

        //条件
        $where = [
            ['car_del','=',1]
        ];
        $carInfo = Car::leftjoin('goods','car.goods_id','=','goods.goods_id')->where($where)->get();

        //dd($carInfo);
        $count = Car::where($where)->count();
        return view('index.car.carlist',['carInfo'=>$carInfo,'count'=>$count]);

    }

    //删除购物车列表
    public function getDel(){
        $goods_id = request()->goods_id;
        $goods_id = explode(',',$goods_id);
        $res = Car::whereIn('goods_id',$goods_id)->update(['car_del'=>2]);
        if($res){
            echo 'OK';
        }else{
            echo 'NO';
        }

    }

    //修改购买数量
    public function changeBuyNumber(){
        $goods_id = request()->goods_id;
        $buy_number = request()->buy_number;
        $where=[
            ['goods_id','=',$goods_id],
            ['car_del','=',1]
        ];
        $result = Car::where($where)->update(['buy_number'=>$buy_number]);

        if($result!==false){
            echo "ok";
        }else{
            echo "no";
        }
    }

    //获取总价
    public function getTotalprice(){

        //echo 111;
        $goods_id = request()->goods_id;
        //echo $goods_id;
        $goods_id = explode(',',$goods_id);

        $info=Goods::leftjoin('car','goods.goods_id','=','car.goods_id')->where('car_del','=',1)->whereIn('goods.goods_id',$goods_id)->get();
        $money=0;
        foreach($info as $k=>$v){
            $money+=$v['goods_price']*$v['buy_number'];
        }
        echo $money;
    }

    //获取小计
    public function getSubtotal(){
        $goods_id = request()->goods_id;
        $goods_price=Goods::where('goods_id',$goods_id)->value('goods_price');
        $where=[
            ['goods_id','=',$goods_id],
            ['car_del','=',1]
        ];
        $buy_number = Car::where($where)->value('buy_number');
        $total = $goods_price*$buy_number;
        echo $total;
    }




}
