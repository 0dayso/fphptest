
	<li<?php echo isset($menu) && in_array($menu, array('article-news', 'article-add-news','article-video', 'article-add-video')) ? ' class="open active"' : '' ?>>
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-file-text"></i>
			<span class="menu-text">
				媒体信息
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			<li<?php echo isset($menu) && 'article-add-news' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save?cid=30&action=article&type=article-add-news">
					<i class="menu-icon fa fa-caret-right"></i>
					添加新闻
				</a>

				<b class="arrow"></b>
			</li>

			<li<?php echo isset($menu) && 'article-news' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/index?cid=30&action=article&type=article-news">
					<i class="menu-icon fa fa-caret-right"></i>
					新闻列表
				</a>

				<b class="arrow"></b>
			</li>

			<li<?php echo isset($menu) && 'article-add-video' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/save?cid=31&action=article&type=article-add-video">
					<i class="menu-icon fa fa-caret-right"></i>
					添加视频
				</a>

				<b class="arrow"></b>
			</li>
			<li<?php echo isset($menu) && 'article-video' == $menu ? ' class="active"' : '' ?>>
				<a href="/admin/article/index?cid=31&action=article&type=article-video">
					<i class="menu-icon fa fa-caret-right"></i>
					视频列表
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>