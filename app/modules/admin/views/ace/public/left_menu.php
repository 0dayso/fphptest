<ul class="nav nav-list">
	<li<?php echo isset($menu) && in_array($menu, array('setting', 'setting-changepwd')) ? ' class="open active"' : '' ?>>
		<a href="#"  class="dropdown-toggle">
			<i class="menu-icon fa fa-cog"></i>
			<span class="menu-text"> 网站设置 </span>
			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>
		
		<ul class="submenu">
			<li<?php echo isset($menu) && 'setting' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin">
					<i class="menu-icon fa fa-caret-right"></i>
					网站设置
				</a>

				<b class="arrow"></b>
			</li>
			<li<?php echo isset($menu) && 'setting-changepwd' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/index/changepwd">
					<i class="menu-icon fa fa-caret-right"></i>
					修改密码
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>
	<li<?php echo isset($menu) && in_array($menu, array('logout')) ? ' class="open active"' : '' ?>>
		<a href="/admin/logout">
			<i class="menu-icon fa fa-power-off"></i>
			<span class="menu-text">
				退出系统
			</span>
		</a>
	</li>
</ul><!-- /.nav-list -->