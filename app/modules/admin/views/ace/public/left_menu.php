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
	<li<?php echo isset($menu) && in_array($menu, array('nav', 'nav-category')) ? ' class="open active"' : '' ?>>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-sitemap"></i>
			<span class="menu-text">自定义导航</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>
		
		<ul class="submenu">
			<li<?php echo isset($menu) &&  in_array($menu, array('nav', 'nav-category')) ? ' class="active"' : '' ?>>
				<a href="/admin/menu">
					<i class="menu-icon fa fa-caret-right"></i>
					自定义导航
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>

	<li<?php echo isset($menu) && in_array($menu, array('cats', 'cats-category')) ? ' class="open active"' : '' ?>>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-th-list"></i>
			<span class="menu-text">栏目管理</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>
		
		<ul class="submenu">
			<li<?php echo isset($menu) &&  in_array($menu, array('cats', 'cats-category')) ? ' class="active"' : '' ?>>
				<a href="/admin/menu/cats">
					<i class="menu-icon fa fa-caret-right"></i>
					栏目管理
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>
	<li<?php echo isset($menu) && in_array($menu, array('home-adbout', 'home-contact1','home-contact2','home-contact3','home-contact4','home-contact5','home-contact6')) ? ' class="open active"' : '' ?>>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-file-text"></i>
			<span class="menu-text">
				主页内容
			</span>
			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>
		<ul class="submenu">
			<li<?php echo isset($menu) && 'home-adbout' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/home/32?action=article&type=home-adbout">
					<i class="menu-icon fa fa-caret-right"></i>
					关于精舍 
				</a>
				<b class="arrow"></b>
			</li>
			<li<?php echo isset($menu) && 'home-contact1' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/home/26?action=article&type=home-contact1">
					<i class="menu-icon fa fa-caret-right"></i>
					特色项目(一)
				</a>
				<b class="arrow"></b>
			</li>
			<li<?php echo isset($menu) && 'home-contact2' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/home/27?action=article&type=home-contact2">
					<i class="menu-icon fa fa-caret-right"></i>
					特色项目(二)
				</a>
				<b class="arrow"></b>
			</li>
			<li<?php echo isset($menu) && 'home-contact3' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/home/28?action=article&type=home-contact3">
					<i class="menu-icon fa fa-caret-right"></i>
					特色项目(三)
				</a>

				<b class="arrow"></b>
			</li>
			<li<?php echo isset($menu) && 'home-contact4' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/home/29?action=article&type=home-contact4">
					<i class="menu-icon fa fa-caret-right"></i>
					特色项目(四)
				</a>

				<b class="arrow"></b>
			</li>
			<li<?php echo isset($menu) && 'home-contact5' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/home/30?action=article&type=home-contact5">
					<i class="menu-icon fa fa-caret-right"></i>
					特色项目(五)
				</a>

				<b class="arrow"></b>
			</li>
			<li<?php echo isset($menu) && 'home-contact6' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/home/31?action=article&type=home-contact6">
					<i class="menu-icon fa fa-caret-right"></i>
					特色项目(六)
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>

	<li<?php echo isset($menu) && in_array($menu, array('article-twms','article-tshx','article-djjy')) ? ' class="open active"' : '' ?>>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-file-text"></i>
			<span class="menu-text">
				精致餐饮
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			<li<?php echo isset($menu) && 'article-twms' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/3?cid=85&action=article&type=article-twms">
					<i class="menu-icon fa fa-caret-right"></i>
					台湾美食
				</a>

				<b class="arrow"></b>
			</li>

			<li<?php echo isset($menu) && 'article-tshx' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/4?cid=4&action=article&type=article-tshx">
					<i class="menu-icon fa fa-caret-right"></i>
					特色海鲜
				</a>

				<b class="arrow"></b>
			</li>
			<li<?php echo isset($menu) && 'article-djjy' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/5?cid=87&action=article&type=article-djjy">
					<i class="menu-icon fa fa-caret-right"></i>
					当季佳肴
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>
	<li<?php echo isset($menu) && in_array($menu, array( 'article-hmzwy','article-etly','article-ssly','article-tyqznc','article-hssyjd','article-ltdjgc')) ? ' class="open active"' : '' ?>>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-file-text"></i>
			<span class="menu-text">
				民俗休闲
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			<li<?php echo isset($menu) && 'article-etly' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/15?cid=79&action=article&type=article-etly">
					<i class="menu-icon fa fa-caret-right"></i>
					儿童乐园
				</a>

				<b class="arrow"></b>
			</li>

			<li<?php echo isset($menu) && 'article-ssly' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/16?cid=80&action=article&type=article-ssly">
					<i class="menu-icon fa fa-caret-right"></i>
					水上乐园
				</a>

				<b class="arrow"></b>
			</li>
			<li<?php echo isset($menu) && 'article-tyqznc' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/17?cid=81&action=article&type=article-tyqznc">
					<i class="menu-icon fa fa-caret-right"></i>
					田园亲子农场
				</a>

				<b class="arrow"></b>
			</li>

			<li<?php echo isset($menu) && 'article-hmzwy' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/20?cid=82&action=article&type=article-hmzwy">
					<i class="menu-icon fa fa-caret-right"></i>
					花木植物园
				</a>

				<b class="arrow"></b>
			</li>
			<li<?php echo isset($menu) && 'article-hssyjd' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/19?cid=83&action=article&type=article-hssyjd">
					<i class="menu-icon fa fa-caret-right"></i>
					 婚纱摄影基地
				</a>

				<b class="arrow"></b>
			</li>
			<li<?php echo isset($menu) && 'article-ltdjgc' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/18?cid=84&action=article&type=article-ltdjgc">
					<i class="menu-icon fa fa-caret-right"></i>
					  露天电影广场
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>

	<li<?php echo isset($menu) && in_array($menu, array('article-synopsis', 'article-speech','article-org','article-org_committee')) ? ' class="open active"' : '' ?>>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-file-text"></i>
			<span class="menu-text">
				关于我们
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			<li<?php echo isset($menu) && 'article-speech' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/9?cid=74&action=article&type=article-speech">
					<i class="menu-icon fa fa-caret-right"></i>
					企业文化
				</a>

				<b class="arrow"></b>
			</li>
			<li<?php echo isset($menu) && 'article-org_committee' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/10?cid=75&action=article&type=article-org_committee">
					<i class="menu-icon fa fa-caret-right"></i>
					项目背景
				</a>

				<b class="arrow"></b>
			</li>

			<li<?php echo isset($menu) && 'article-org' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/7?cid=76&action=article&type=article-org">
					<i class="menu-icon fa fa-caret-right"></i>
					关于我们
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>

	<li<?php echo isset($menu) && in_array($menu, array('article-ljdjw', 'article-rwkz')) ? ' class="open active"' : '' ?>>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-file-text"></i>
			<span class="menu-text">
				乡村度假村
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			<li<?php echo isset($menu) && 'article-ljdjw' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/1?cid=77&action=article&type=article-ljdjw">
					<i class="menu-icon fa fa-caret-right"></i>
					林间度假屋
				</a>

				<b class="arrow"></b>
			</li>

			<li<?php echo isset($menu) && 'article-rwkz' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/2?cid=78&action=article&type=article-rwkz">
					<i class="menu-icon fa fa-caret-right"></i>
					人文客栈
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>

	<li<?php echo isset($menu) && in_array($menu, array('article-linkus')) ? ' class="open active"' : '' ?>>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-file-text"></i>
			<span class="menu-text">
				联系我们
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			<li<?php echo isset($menu) && 'article-linkus' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save/11?cid=72&action=article&type=article-linkus">
					<i class="menu-icon fa fa-caret-right"></i>
					联系我们
				</a>

				<b class="arrow"></b>
			</li>

		</ul>
	</li>

	<li<?php echo isset($menu) && in_array($menu, array('article-manager')) ? ' class="open active"' : '' ?>>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-file-text"></i>
			<span class="menu-text">
				数据管理
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			<li<?php echo isset($menu) && 'article-manager' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/manager?action=article&type=article-manager">
					<i class="menu-icon fa fa-caret-right"></i>
					图文内容列表
				</a>

				<b class="arrow"></b>
			</li>

		</ul>
	</li>
	
	<li<?php echo isset($menu) && in_array($menu, array('ad', 'ad-add')) ? ' class="open active"' : '' ?>>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-tachometer"></i>
			<span class="menu-text">
				图片素材管理
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			<li<?php echo isset($menu) && 'ad-add' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save?cid=88&action=ad&type=ad-add">
					<i class="menu-icon fa fa-caret-right"></i>
					添加素材
				</a>

				<b class="arrow"></b>
			</li>

			<li<?php echo isset($menu) && 'ad' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article?action=ad&cid=88&type=ad">
					<i class="menu-icon fa fa-caret-right"></i>
					 素材列表
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>
	<li<?php echo isset($menu) && in_array($menu, array('link-list', 'link-add')) ? ' class="open active"' : '' ?>>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-tachometer"></i>
			<span class="menu-text">
				友情链接
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			<li<?php echo isset($menu) && 'link-add' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/link/save?action=link&type=link-add">
					<i class="menu-icon fa fa-caret-right"></i>
					添加链接
				</a>

				<b class="arrow"></b>
			</li>

			<li<?php echo isset($menu) && 'link-list' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/link?action=link-list&cid=46&type=link-list">
					<i class="menu-icon fa fa-caret-right"></i>
					友情列表
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