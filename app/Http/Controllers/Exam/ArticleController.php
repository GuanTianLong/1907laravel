<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Article;
use App\Model\Type;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *文章列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article_title = request()->article_title;
        //echo $article_title;
        $type_id = request()->type_id;

        $where = [];

        if($article_title){
                $where[] = ['article_title','like',"%$article_title%"];
        }

        if($type_id){
            $where[] = ['article.type_id','=',$type_id];
        }
        //查询分类表的所有数据----作为文章分类下拉菜单的值
        $typeInfo = Type::get();
        //dd($typeInfo);

        $page = config('app.pageSize');

        $articleInfo = Article::join('Type','article.type_id','=','type.type_id')->where($where)->orderBy('article_id','desc')->paginate($page);
        //dd($articleInfo);
        $query = request()->all();
       //dump($query);
        return view('exam.article.index',['articleInfo'=>$articleInfo,'typeInfo'=>$typeInfo,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *文章添加视图
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //查询分类表的所有数据----作为文章分类下拉菜单的值
        $typeInfo = Type::get();
        //dd($typeInfo);

        return view('exam.article.create',['typeInfo'=>$typeInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *执行文章添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        //文件上传
        if($request->hasFile('files')){
                $data['files'] = $this->upload('files');
        }

        //添加时间
        $data['add_time'] = time();

        //验证
        $request->validate([
            'article_title' => 'required|unique:article|max:20|min:2',
        ],[
                'article_title.required'=>'文章标题必填',
                'article_title.unique'=>'文章标题已存在',
                'article_title.max'=>'文章标题长度最大为18',
                'article_title.min'=>'文章标题长度最小为2',
            ]
        );

        //dd($data);
        //入库
        $res = Article::create($data);

        echo "<script>alert('文章添加成功');location.href='/article';</script>";
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
     *文章编辑
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = [
            ['article_id','=',$id]
        ];

        //查询分类表的所有数据----作为文章分类下拉菜单的值
        $typeInfo = Type::get();

        //查询文章表的一条数据
        $articleInfo = Article::where($where)->first();
        //dd($articleInfo);

        return view('exam.article.edit',['typeInfo'=>$typeInfo],['articleInfo'=>$articleInfo]);
    }

    /**
     * Update the specified resource in storage.
     *执行文章编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->except('_token');

        //文件上传
        if($request->hasFile('files')){
            $data['files'] = $this->upload('files');
        }
        //验证
        $request->validate([
            'article_title' => 'required|unique:article|max:20|min:2',
        ],[
                'article_title.required'=>'文章标题必填',
                'article_title.unique'=>'文章标题已存在',
                'article_title.max'=>'文章标题长度最大为18',
                'article_title.min'=>'文章标题长度最小为2',
            ]
        );

        $where = [
            ['article_id','=',$id]
        ];

        $res = Article::where($where)->update($data);
        if($res!==false){
            echo "<script>alert('文章编辑成功');location.href='/article';</script>";
        }


    }

    /**
     * Remove the specified resource from storage.
     *执行文章删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //dd($id);
        $res=Article::destroy($id);
        if ($res){
            echo "ok";
        }else{
            echo "no";
        }
    }

    /**文件上传*/
    public function upload($file){
        if (request()->file($file)->isValid()) {
            $photo = request()->file($file);
            $extension = $photo->extension();
            $store_result = $photo->store('files');
            //$store_result = $photo->storeAs('photo', 'test.jpg');

            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');

    }

}
