<div class="menu">
    <ul class="mainmenu" style="float: left;text-align: center;z-index:2;">
        <li>
            <a href="/admin"><span><i class="glyphicon glyphicon-home"></i>&nbsp;&nbsp;首页</span></a>
        </li>
        <li class="menu-name">
            <span>&nbsp;&nbsp;&nbsp;系统设置</span>
        </li>
        @if(Permission::can('setting'))
            <li>
                <span><i class="glyphicon glyphicon-wrench"></i>网站设置</span>
            </li>
            <ul class="submenu">
                <div class="expand-triangle"></div>
                <li><a href="/admin/setting/1"><span><i class="glyphicon glyphicon-chevron-right"></i>网站SEO</span></a></li>
                <li><a href="/admin/setting/6"><span><i class="glyphicon glyphicon-chevron-right"></i>微信配置</span></a></li>
                <li><span><i class="glyphicon glyphicon-chevron-right"></i>后台设置</span></li>
            </ul>
        @endif
        @if(Permission::can('log'))
            <li>
                <a href="/admin/log"><span><i class="glyphicon glyphicon-pencil"></i>操作日志</span></a>
                <div class="messages">{{count(\App\Log::get())}}</div>
            </li>
        @endif
        <li class="menu-name">
            <span>&nbsp;&nbsp;&nbsp;内容管理</span>
        </li>
        @if(Permission::can('product'))
            <li>
                <span> <i class="glyphicon glyphicon-shopping-cart"></i>商品管理</span>
            </li>
            <ul class="submenu">
                <div class="expand-triangle"></div>
                <li><a href="/admin/product"><span><i class="glyphicon glyphicon-chevron-right"></i>商品</span></a></li>
                <li><span><i class="glyphicon glyphicon-chevron-right"></i>订单</span></li>
            </ul>
        @endif
        @if(Permission::can('wechat'))
            <li>
                <span><img src="/image/wechat.png" style="width: 16px;height:16px;margin-top: -5px;margin-right: 1px;"/>微信管理</span>
            </li>
            <ul class="submenu">
                <div class="expand-triangle"></div>
                <li><a href="/admin/wemenu"><span><i class="glyphicon glyphicon-chevron-right"></i>菜单配置</span></a></li>
                <li><a href="/admin/wereplay"><span><i class="glyphicon glyphicon-chevron-right"></i>自动回复</span></a></li>
                <li><a href=""><span><i class="glyphicon glyphicon-chevron-right"></i>素材管理</span></a></li>
                <li><a href=""><span><i class="glyphicon glyphicon-chevron-right"></i>群发管理</span></a></li>
            </ul>
        @endif
        @if(Permission::can('article'))
            <li>
                <span><i class="glyphicon glyphicon-list-alt"></i>文章管理</span>
            </li>
            <ul class="submenu">
                <div class="expand-triangle"></div>
                <li><a href="/admin/article"><span><i class="glyphicon glyphicon-chevron-right"></i>文章</span></a></li>
                <li><a href="/admin/articleType"><span><i class="glyphicon glyphicon-chevron-right"></i>分类</span></a></li>
            </ul>
        @endif
        @if(Permission::can('page'))
            <li>
                <span><i class="glyphicon glyphicon-file"></i>单页管理</span>
            </li>
        @endif
        <li class="menu-name">
            <span>&nbsp;&nbsp;&nbsp;帐号管理</span>
        </li>
        @if(Permission::can('auser'))
            <li>
                <a href="/admin/admin"><span><i class="glyphicon glyphicon-magnet"></i>用户管理</span></a>
            </li>
        @endif
        @if(Permission::can('user'))
            <li>
                <a href="/admin/user"><span> <i class="glyphicon glyphicon-user"></i>会员管理</span></a>
            </li>
        @endif

    </ul>
</div>





