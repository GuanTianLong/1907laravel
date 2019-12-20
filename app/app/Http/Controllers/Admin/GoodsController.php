<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Brand;
use App\Model\Goods;
use App\Model\Category;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *商品列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $goods_name = request()->goods_name;

        $brand_id = request()->brand_id;

        $where = [];

        if($goods_name){
                $where[] = ['goods_name','like',"%$goods_name%"];
        }

        if($brand_id){
            $where[] = ['goods.brand_id','=',$brand_id];
        }


        //查询品牌表的所有数据----作为品牌的下拉菜单
        $brandInfo = Brand::get();

        //查询商品表的所有数据----作为列表展示
        $goodsInfo = Goods::join('brand','goods.brand_id','=','brand.brand_id')
                            ->join('category','goods.cate_id','=','category.cate_id')
                            ->where($where)
                            ->get();

        //dd($goodsInfo);
        foreach($goodsInfo as $k=>$v){
            $goodsInfo[$k]['goods_imgs'] = explode('|',$v['goods_imgs']);
        }

        //dd($goodsInfo);

        return view('admin.goods.index',['goodsInfo'=>$goodsInfo,'brandInfo'=>$brandInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *商品添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //查询品牌表的所有数据----作为品牌的下拉菜单
        $brandInfo = Brand::get();

        //查询分类表的所有数据----作为分类的下拉菜单
        $data = Category::get();

        $cateInfo = $this->getCateInfo($data);

        return view('admin.goods.create',['brandInfo'=>$brandInfo],['cateInfo'=>$cateInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        //单文件上传
        if( $request->hasFile('goods_img')){

            $data['goods_img'] = $this->goods_img(['goods_img']);

        }

        //多文件上传
        if($request->hasFile('goods_imgs')){
            $goods_imgs = $this->goods_img('goods_imgs');
            $data['goods_imgs'] = implode('|',$goods_imgs);
        }
        //dd($data);

        $res = Goods::create($data);

        echo "<script>alert('商品添加成功');location.href='/goods';</script>";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *商品修改
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //echo $id;
        //查询品牌表的所有数据----作为品牌的下拉菜单
        $brandInfo = Brand::get();

        //查询分类表的所有数据----作为分类的下拉菜单
        $data = Category::get();

        $cateInfo = $this->getCateInfo($data);

        $where = [
            ['goods_id','=',$id]
        ];

        //查询商品表的一条数据-----作为编辑页面的默认值
        $goodsInfo = Goods::where($where)->first();

        $goodsInfo['goods_imgs'] = explode('|',$goodsInfo['goods_imgs']);

        return view('admin.goods.edit',['brandInfo'=>$brandInfo,'cateInfo'=>$cateInfo,'goodsInfo'=>$goodsInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //echo $id;
        $data = $request->except('_token');

        //单文件上传
        if( $request->hasFile('goods_img')){

            $data['goods_img'] = $this->goods_img(['goods_img']);

        }

        //多文件上传
        if($request->hasFile('goods_imgs')){
            $goods_imgs = $this->goods_img('goods_imgs');
            $data['goods_imgs'] = implode('|',$goods_imgs);
        }
        //dd($data);

        $where = [
            ['goods_id','=',$id]
        ];

        $res = Goods::where($where)->update($data);
        if($res!==false){
            echo "<script>alert('商品编辑成功');location.href='/goods';</script>";
        }
            echo "<script>alert('商品编辑失败');location.href='/goods/edit';</script>";

    }

    /**
     * Remove the specified resource from storage.
     *执行商品删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //echo $id;
        $res = Goods::destroy($id);

        echo "<script>alert('商品删除成功');location.href='/goods';</script>";

    }


    /**无限极分类-----递归*/
    public function getCateInfo($data,$parent_id=0,$level=0){
        static $info = [];
        foreach($data as $k=>$v){
            if($parent_id == $v['parent_id']){
                $v['level'] = $level;
                $info[] = $v;
                $this->getCateInfo($data,$v['cate_id'],$level+1);
            }
        }
        return $info;
    }


    /**支持单,多文件上传*/
    public function goods_img($file){

        $imgs = request()->file($file);
        if(is_array($imgs)){
            //多文件上传
            $result = [];
            foreach($imgs as $v){
                //验证文件是否上传成功
                if ($v->isValid()){
                    //接收文件并上传
                    $result[] = $v->store('goods_imgs');
                    //返回上传的文件路径
                }
            }
            return $result;
        }else{
            //单文件上传
            //验证文件是否上传成功
            if ($imgs->isValid()){
                //接收文件并上传
                $path = request()->file($file)->store('goods_img');
                //返回上传的文件路径
                return $path;
            }
        }
        exit('未获取到上传文件或上传过程出错');

    }

}

