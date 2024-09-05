<!-- header -->
<header class="main-header">
    <a href="/admin" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b><?=_SITE_NAME?> Admin</b></span>
    </a>

    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="//<?=_RESOURCE_URL?>/resource/js/AdminLTE-2.4.2/dist/img/avatar5.png" class="user-image" alt="User Image"/>
                <span class="hidden-xs"><?=getLoginName()?></span>
            </a>
            <ul class="dropdown-menu">
                <li class="user-header">
                    <img src="//<?=_RESOURCE_URL?>/resource/js/AdminLTE-2.4.2/dist/img/avatar5.png" class="img-circle" alt="User Image" />
                    <p>
                    <?=getLoginName()?> - Web Administrator
                    <small><?=_SITE_NAME?> 관리자</small>
                    </p>
                </li>
                <li class="user-footer">
                    <div class="pull-right">
                        <a href="?tpf=_module/member/logout" class="btn btn-danger btn-flat">Sign out</a>
                    </div>
                </li>
            </ul>
            </li>
        </ul>
        </div>
    </nav>
</header><!-- /.header -->