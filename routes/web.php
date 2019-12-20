<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//闭包函数路由
//Route::get('/', function () {
//    echo 'hello laravel';
//});

//路由视图
//Route::view('/hello','welcome',['welcome'=>'欢迎加入Laravel']);

//get路由
//Route::get('login','Index\Login@login');
//Route::view('/hello','index\welcome',['welcome'=>'欢迎加入Laravel']);

//post路由
//Route::post('loginDo','Index\Login@loginDo')->name('LL');
//路由参数-----必选参数(正则约束)
//Route::get('lists/{id}/{name}','Index\Login@lists')->where(['id'=>'\d+','name'=>'\w+']);

//路由参数-----可选参数
//Route::get('gets/{id}/{name?}','Index\Login@gets');

//路由参数-----闭包函数
//Route::get('index/{name?}', function ($name="张三"){
//
//    return $name;
//});

//全局约束
//Route::get('test/{id}/{name}','Index\Login@test');


/**登录路由前缀*/
Route::prefix('login/')->group(function () {

    /**用户登录*/
    Route::get('/','Admin\LoginController@login');

    /**执行登录*/
    Route::post('loginDo','Admin\LoginController@loginDo');

});

/**品牌路由名称前缀*/
Route::prefix('brand')->middleware('auth')->group(function () {

    /**品牌列表*/
    Route::get('/','Admin\BrandController@index');

    /**品牌添加*/
    Route::get('create','Admin\BrandController@create');

    /**执行添加*/
    Route::post('store','Admin\BrandController@store');

    /**执行删除*/
    Route::get('destroy/{id}','Admin\BrandController@destroy');

    /**编辑视图*/
    Route::get('edit/{id}','Admin\BrandController@edit');

    /**执行编辑*/
    Route::post('update/{id}','Admin\BrandController@update');

    /**ajax验证品牌名称唯一性*/
    Route::post('checkName','Admin\BrandController@checkName');


});

/**分类路由名称前缀*/
Route::prefix('category')->middleware('auth')->group(function () {

    /**分类列表*/
    Route::get('/','Admin\CategoryController@index');

    /**分类添加*/
    Route::get('create','Admin\CategoryController@create');

    /**执行分类添加*/
    Route::post('store','Admin\CategoryController@store');

    /**执行分类删除*/
    Route::get('destroy/{id}','Admin\CategoryController@destroy');

    /**分类编辑*/
    Route::get('edit/{id}','Admin\CategoryController@edit');

    /**执行分类编辑*/
    Route::post('update/{id}','Admin\CategoryController@update');


});

/**管理员路由名称前缀*/
Route::prefix('admin')->middleware('auth')->group(function () {

    /**后台首页*/
    Route::get('indexs','Admin\AdminController@indexs');

    /**管理员列表*/
    Route::get('/','Admin\AdminController@index');

    /**管理员添加*/
    Route::get('create','Admin\AdminController@create');

    /**执行管理员添加*/
    Route::post('store','Admin\AdminController@store');

    /**执行管理员删除*/
    Route::get('destroy/{id}','Admin\AdminController@destroy');

    /**管理员编辑*/
    Route::get('edit/{id}','Admin\AdminController@edit');

    /**执行管理员编辑*/
    Route::post('update/{id}','Admin\AdminController@update');


});

/**商品路由名称前缀*/
Route::prefix('goods')->middleware('auth')->group(function () {

    /**商品列表*/
    Route::get('/','Admin\GoodsController@index');

    /**商品添加*/
    Route::get('create','Admin\GoodsController@create');

    /**执行商品添加*/
    Route::post('store','Admin\GoodsController@store');

    /**执行商品删除*/
    Route::get('destroy/{id}','Admin\GoodsController@destroy');

    /**商品编辑*/
    Route::get('edit/{id}','Admin\GoodsController@edit');

    /**执行商品编辑*/
    Route::post('update/{id}','Admin\GoodsController@update');


});

/**文章路由前缀*/
Route::prefix('article')->middleware('checkLogin')->group(function () {

    /**文章列表*/
    Route::get('/','Exam\ArticleController@index');

    /**文章添加*/
    Route::get('create','Exam\ArticleController@create');

    /**执行文章添加*/
    Route::post('store','Exam\ArticleController@store');

    /**执行文章删除*/
    Route::get('destroy/{id}','Exam\ArticleController@destroy');

    /**文章编辑*/
    Route::get('edit/{id}','Exam\ArticleController@edit');

    /**执行文章编辑*/
    Route::post('update/{id}','Exam\ArticleController@update');


});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


/**前台首页*/
Route::get('/','Index\Index@index');

/**用户首页*/
Route::get('/user','Index\UserController@index');

/**前台登陆*/
//Route::get('/login','Index\LoginController@login');

/**前台注册*/
Route::get('/register','Index\RegisterController@register');

/**获取注册验证码*/
Route::get('/register/sendCode','Index\RegisterController@sendCode');

/**商品展示*/
Route::get('/prolist/{id}','Index\ProlistController@prolist');

/**商品详情*/
Route::get('/proinfo/{id}','Index\ProinfoController@proinfo');

/**购物车列表*/
Route::get('/carlist','Index\CarController@carlist');

/**购物车列表*/
Route::get('/carlist','Index\CarController@carlist');

/**点击删除*/
Route::post('/getDel','Index\CarController@getDel');

/**修改购买数量*/
Route::post('/changeBuyNumber','Index\CarController@changeBuyNumber');

/**重新获取小计*/
Route::post('/getSubtotal','Index\CarController@getSubtotal');

/**重新获取总价*/
Route::post('/getTotalprice','Index\CarController@getTotalprice');

/**点击加入购物车*/
Route::post('/addCar','Index\CarController@addCar');

/**去结算*/
Route::get('/confirmpay','Index\ConfirmpayController@confirmpay');

/**发送邮件*/
Route::get('/send_email','Index\MailController@send_email');

/**收货地址*/
Route::get('/address','Index\AddressController@address');

/**三级联动*/
Route::post('/getplace/{id}','Index\AddressController@getplace');