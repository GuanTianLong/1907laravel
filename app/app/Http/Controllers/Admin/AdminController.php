<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin;
use DB;

class AdminController extends Controller
{


    /**后台首页*/
    public function indexs(){

        return view('admin.admin.indexs');
    }


    /**
     * Display a listing of the resource.
     *管理员列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $account = Request()->account;

        $where = [];

        if($account){
                $where[] = ['account','like',"%$account%"];
        }

        $page = config('app.pageSize');

        //监听sql
       // DB::connection()->enableQueryLog();

        $adminInfo = Admin::where($where)->orderBy('admin_id','desc')->paginate($page);

        //$logs =DB::getQueryLog();

        //dd($logs);

        $query = Request()->all();

        return view('admin.admin.index',['adminInfo'=>$adminInfo,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *管理员添加视图
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行管理员添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        //文件上传
        if(request()->hasFile('admin_photo')){
                $data['admin_photo']=$this->adminPhoto(['admin_photo']);
        }


        $res = Admin::create($data);
        if($res){
            //跳转
            echo "<script>alert('管理员添加成功');location.href='/admin'</script>";

            //return redirect('admin');

        }
        echo "no";die;

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
     *管理员编辑视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //echo $id;die;
        //根据管理员id查询管理员表的一条数据作为编辑页面的默认值
        $adminInfo = Admin::where('admin_id','=',$id)->first();

        return view('admin.admin.edit',['adminInfo'=>$adminInfo]);
    }

    /**
     * Update the specified resource in storage.
     *执行管理员编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //echo $id;
        $data = $request->except('_token');

        //文件上传
        if (request()->hasFile('admin_photo')) {
            $data['admin_photo'] = $this->adminPhoto(['admin_photo']);
        }

        $res = Admin::where('admin_id','=',$id)->update($data);
        if ($res) {
            //跳转
            echo "<script>alert('管理员编辑成功');location.href='/admin'</script>";

            //return redirect('admin');

        }
            echo "no";die;

    }

    /**
     * Remove the specified resource from storage.
     *执行管理员删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       $res = Admin::destroy($id);

       echo "<script >alert('管理员删除成功');location.href='/admin'</script>";

       //return redirect('admin');
    }


    /**文件上传*/
    public function adminPhoto($file){
        if (request()->file($file)->isValid()) {
            $photo = request()->file($file);
            $extension = $photo->extension();
            $store_result = $photo->store('adminPhoto');
            //$store_result = $photo->storeAs('photo', 'test.jpg');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');



    }
}
