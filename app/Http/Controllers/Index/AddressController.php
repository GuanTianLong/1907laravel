<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Area;

class AddressController extends Controller
{
    /**收货地址的添加*/
    public function address(){

        $where = [
            ['pid','=',0]
        ];

        $provinceInfo = Area::where($where)->get();
        //dd($provinceInfo);
        return view('index.address.address',['provinceInfo'=>$provinceInfo]);
    }


    /**获取区域信息*/
    public function getPlaceInfo($id){
        //echo $id;
        $where=[
            ['pid','=',$id]
        ];
        return Area::where($where)->get();
    }


    public function getplace($id){
        //$id=request()->id;
        //echo  $id;
        if(!$id==0){
            $info=$this->getPlaceInfo($id);
            //dump($info);
            echo json_encode($info);
        }
    }





}
