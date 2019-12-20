
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>后台首页</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/jquery.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>

<h3 style="color:#f99b15" align="center">后台首页</h3>

<b><hr></b>

欢迎<b style="color:purple" align="cener">{{Auth::user()->name}}</b>登陆

<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion"
                   href="#collapseOne">
                    <button type="button" class="btn btn-info">商品管理</button>
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
                <a href="{{'/goods/create'}}"><button type="button" class="btn btn-info">商品添加</button></a>
            </div>
            <div class="panel-body">
                <a href="{{'/goods'}}"><button type="button" class="btn btn-info">商品列表</button></a>
            </div>
        </div>
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion"
                   href="#collapseTwo">
                    <button type="button" class="btn btn-info">品牌管理</button>
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">
                <a href="{{'/brand/create'}}"><button type="button" class="btn btn-info">品牌添加</button></a>
            </div>
            <div class="panel-body">
                <a href="{{'/brand'}}"><button type="button" class="btn btn-info">品牌列表</button></a>
            </div>
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion"
                   href="#collapseThree">
                    <button type="button" class="btn btn-info">分类管理</button>
                </a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">
                <a href="{{'/category/create'}}"><button type="button" class="btn btn-info">分类添加</button></a>
            </div>
            <div class="panel-body">
                <a href="{{'/category'}}"><button type="button" class="btn btn-info">分类列表</button></a>
            </div>
        </div>
    </div>
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion"
                   href="#collapseFour">
                    <button type="button" class="btn btn-info">管理员管理</button>
                </a>
            </h4>
        </div>
        <div id="collapseFour" class="panel-collapse collapse">
            <div class="panel-body">
                <a href="{{'/admin/create'}}"><button type="button" class="btn btn-info">管理员添加</button></a>
            </div>
            <div class="panel-body">
                <a href="{{'/admin'}}"><button type="button" class="btn btn-info">管理员列表</button></a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () { $('#collapseFour').collapse({
        toggle: false
    })});
    $(function () { $('#collapseTwo').collapse('show')});
    $(function () { $('#collapseThree').collapse('toggle')});
    $(function () { $('#collapseOne').collapse('hide')});
</script>

</body>
</html>

