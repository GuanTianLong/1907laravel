<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Category;

class ProlistController extends Controller
{
    public function prolist($id){

        //dd($id);
        //查询分类表的所有数据
        $cateInfo = category::get();
        //dd($cateInfo);
        $cate_id = $this->getCateId($cateInfo,$id);
        //dd($cate_id);

        $goodsInfo = Goods::whereIn('cate_id',$cate_id)->get();
        //dd($goodsInfo);

        return view('index.prolist.prolist',['goodsInfo'=>$goodsInfo]);
    }

    function getCateId($cateInfo,$parent_id){

        static $cate_id=[];

        $cate_id[$parent_id]=$parent_id;

        foreach ($cateInfo as $k => $v) {

            if($v['parent_id']==$parent_id){

                $cate_id[$v['cate_id']]=$v['cate_id'];

                $this->getCateId($cateInfo,$v['cate_id']);

            }
        }
        return $cate_id;

    }


}
