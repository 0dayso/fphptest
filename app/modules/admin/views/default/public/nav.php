<?php $global = \Session::get('GLOBAL_OPTION', false); ?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $global && $global['site_admin_name'] ? $global['site_admin_name'] : ''; ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">基础数据设置 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/admin/category/roots">所有树设置</a></li>
                        <li><a href="/admin/permission">所有权限设置</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">admin <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a data-toggle="modal" data-target="#changePwdModal">修改密码</a></li>
                        <!--<li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>-->
                        <li class="divider"></li>
                        <li><a href="/logout">安全退出</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>