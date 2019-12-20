<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *分类列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cateInfo = Category::get();
        return view('admin.category.index',['cateInfo'=>$cateInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *分类添加视图
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::get();
        $cateInfo = $this->getCateInfo($data);
        //dd($cateInfo);
        return view('admin.category.create',['cateInfo'=>$cateInfo]);
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

    /**
     * Store a newly created resource in storage.
     *执行分类添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        //dd($data);
        $res = Category::create($data);

        //dd(res);

        echo "<script>alert('分类添加成功');location.href='/category'</script>";

    }

    /**
     * Display the specified resource.
     *分类详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *分类编辑视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //根据分类id查询分类表的一条数据
        $info = Category::where('cate_id','=',$id)->first();
        //查询分类表的数据获取下拉菜单的值
        $data = Category::get();

        $cateInfo = $this->getCateInfo($data);
        //dd($cateInfo);
        return view('admin.category.edit',['cateInfo'=>$cateInfo,'info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *执行分类编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        //dd($data);
        $cate= new Category();
        $res =  $cate->save($data,[['cate_id','=',$id]]);

        //跳转
        echo "<script>alert('分类修改成功');location.href='/category'</script>";

        //return redirect('category');



    }

    /**
     * Remove the specified resource from storage.
     *执行分类删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $count = Category::where('parent_id','=',$id)->count();
        //dd($count);
        if($count>0){
            echo "<script>alert('此分类下有子类,禁止删除');location.href='/category'</script>";
        }else{

            $res = Category::destroy($id);
            //跳转
            echo "<script>alert('分类删除成功');location.href='/category'</script>";

            //return redirect('category');


        }


    }


}
