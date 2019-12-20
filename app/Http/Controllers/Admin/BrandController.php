<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Brand;
use DB;
use Validator;
//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *品牌列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /* session(['brand_name'=>'耐克']);  //设置

         request()->session()->save();   //储存到服务器断

         $res = session(['brand_name'=>null]);    //删除

         request()->session()->save();

         $res = session('brand_name');   //获取session

         //request实例
         request()->session()->put(['brand_name'=>'Apple']); //设置

         request()->session()->save();   //储存到服务器断

         //pull 方法将会通过一条语句从 Session 获取并删除数据：
         $res1 = request()->session()->pull('brand_name');

         $res = request()->session()->get('brand_name');     //获取

         //dd($res);

         //forget 方法从 Session 中移除指定数据，
         $res = request()->session()->forget('brand_name');  //删除单个session

         $res = request()->session()->get('brand_name');     //获取

         //如果你想要从 Session 中移除所有数据，可以使用 flush 方法
         $res = request()->session()->flush();

         dd($res);*/

        $brand_name = request()->brand_name;
        $brand_url = request()->brand_url;

        $where = [];

        if($brand_name){
            $where[] = ['brand_name','like',"%$brand_name%"];
        }

        if($brand_url){
            $where[] = ['brand_url','like',"%$brand_url%"];
        }

        $page = request()->page;
        //$data = Cache::get('data_'.$page.'_'.$brand_name.'_'.$brand_url);
        //$data = Cache::get('data_'.$page.'_'.$brand_name.'_'.$brand_url);

        //Redis::del('data_'.$page.'_'.$brand_name.'_'.$brand_url);
        $data = Redis::get('data_'.$page.'_'.$brand_name.'_'.$brand_url);
        $data=unserialize($data);
        echo 'data_'.$page.'_'.$brand_name.'_'.$brand_url;
       //dd($data);
        if(!$data){
            echo "走数据库";
            $pageSize = config('app.pageSize');
            //查询品牌Brand的数据
            //$data = DB::table('brand')->paginate($page);
            //ORM操作
            $data = Brand::where($where)->orderBy('brand_id','desc')->paginate($pageSize);

            //Cache::put(['data_'.$page.'_'.$brand_name.'_'.$brand_url=>$data],20);
            //Cache::put(['data_'.$page.'_'.$brand_name.'_'.$brand_url],20);
            Redis::setex('data_'.$page.'_'.$brand_name.'_'.$brand_url,20,serialize($data));
        }



        $query = request()->all();
        //dd($data);
        return view('admin.brand.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *品牌添加视图
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行品牌添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
        /**第二种验证*/
        //public function store(StoreBrandPost $request)
    {

        //排除...个字段用except()
        $data = $request->except('_token');

        /**第一种验证*/
        $request->validate([
            'brand_name' => 'required|unique:brand|max:18|min:2',
            'brand_url' => 'required'
        ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌已存在',
            'brand_name.max'=>'品牌名称长度最大为18',
            'brand_name.min'=>'品牌名称长度最小为2',
            'brand_url.required'=>'品牌网址必填',
        ]);

        /**第三种验证*/
//                $validator = Validator::make($data, [
//                    'brand_name' => 'required|unique:brand|max:18|min:2',
//                    'brand_url' => 'required'
//                ],[
//                        'brand_name.required'=>'品牌名称必填',
//                        'brand_name.unique'=>'品牌已存在',
//                        'brand_name.max'=>'品牌名称长度最大为18',
//                        'brand_name.min'=>'品牌名称长度最小为2',
//                        'brand_url.required'=>'品牌网址必填'
//                ]);
//
//                if ($validator->fails()) {
//                    return redirect('brand/create')
//                        ->withErrors($validator)
//                        ->withInput();
//                }

        //dd($data);
        //文件上传
        if($request->hasFile('brand_logo') ){

            $data['brand_logo'] = $this->upload('brand_logo');
        }

        //dd($data);
        //$res = DB::table('brand')->insert($data);
        //ORM操作
        //$res = Brand::create($data);
        $res = Brand::insert($data);

        //跳转
        echo "<script>alert('品牌添加成功');location.href='/brand'</script>";
        //return redirect('brand');
    }

    /**
     * Display the specified resource.
     *品牌详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *品牌编辑视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);

        //$data = DB::table('brand')->where([['brand_id','=',$id]])->first();

        //ORM操作
        $data = Brand::where([['brand_id','=',$id]])->first();

        //dd($data);
        return view('admin.brand.edit',['data'=>$data]);

    }

    /**
     * Update the specified resource in storage.
     *执行品牌编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        //dd($data);
        //$res = DB::table('brand')->where('brand_id','=',$id)->update($data);

        //文件上传
        if(request()->hasFile('brand_logo') ){

            $data['brand_logo'] = $this->upload('brand_logo');
        }

        //ORM操作
        $res = Brand::where('brand_id','=',$id)->update($data);
        //跳转
        echo "<script>alert('品牌修改成功');location.href='/brand'</script>";

        //return redirect('brand')->with('update','品牌修改成功');

    }

    /**
     * Remove the specified resource from storage.
     *执行品牌删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        //$brand_id =request()->brand_id;
        $res = DB::table('brand')->where([['brand_id','=',$id]])->delete();
        //dd($res);
        echo "<script>alert('品牌删除成功');location.href='/brand'</script>";
        //return redirect('brand');
    }


    /**文件上传*/
    public function upload($img){
        if (request()->file($img)->isValid()) {
            $photo = request()->file($img);
            $store_result = $photo->store('upload');
            //$store_result = $photo->storeAs('photo', 'test.jpg');

            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }

    /**ajax验证品牌名称唯一性*/
    public function checkName(){

        $brand_name = request()->brand_name;
        //dd($brand_name);
        $where = [];
        if($brand_name){
            $where['brand_name'] =$brand_name;
        }

        $count = Brand::where($where)->count();
        //dd($count);
        echo $count;

    }
}
