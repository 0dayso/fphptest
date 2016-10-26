<?php
/**
 * Part of the Fuel framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2014 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */


return array(

	// default FuelPHP pagination template, compatible with pre-1.4 applications
	'default'                     => array(
		'wrapper'                 => "<div class=\"pagination\">\n\t{pagination}\n</div>\n",

		'first'                   => "<span class=\"first\">\n\t{link}\n</span>\n",
		'first-marker'            => "&laquo;&laquo;",
		'first-link'              => "\t\t<a href=\"{uri}\">{page}</a>\n",

		'first-inactive'          => "",
		'first-inactive-link'     => "",

		'previous'                => "<span class=\"previous\">\n\t{link}\n</span>\n",
		'previous-marker'         => "&laquo;",
		'previous-link'           => "\t\t<a href=\"{uri}\" rel=\"prev\">{page}</a>\n",

		'previous-inactive'       => "<span class=\"previous-inactive\">\n\t{link}\n</span>\n",
		'previous-inactive-link'  => "\t\t<a href=\"#\" rel=\"prev\">{page}</a>\n",

		'regular'                 => "<span>\n\t{link}\n</span>\n",
		'regular-link'            => "\t\t<a href=\"{uri}\">{page}</a>\n",

		'active'                  => "<span class=\"active\">\n\t{link}\n</span>\n",
		'active-link'             => "\t\t<a href=\"#\">{page}</a>\n",

		'next'                    => "<span class=\"next\">\n\t{link}\n</span>\n",
		'next-marker'            => "&raquo;",
		'next-link'               => "\t\t<a href=\"{uri}\" rel=\"next\">{page}</a>\n",

		'next-inactive'           => "<span class=\"next-inactive\">\n\t{link}\n</span>\n",
		'next-inactive-link'      => "\t\t<a href=\"#\" rel=\"next\">{page}</a>\n",

		'last'                    => "<span class=\"last\">\n\t{link}\n</span>\n",
		'last-marker'             => "&raquo;&raquo;",
		'last-link'               => "\t\t<a href=\"{uri}\">{page}</a>\n",

		'last-inactive'           => "",
		'last-inactive-link'      => "",
	),

	// Twitter bootstrap 3.x template
	'bootstrap3'                   => array(
		'wrapper'                 => "<ul class=\"pagination\">\n\t{pagination}\n\t</ul>\n",

		'first'                   => "\n\t\t<li>{link}</li>",
		'first-marker'            => "&laquo;&laquo;",
		'first-link'              => "<a href=\"{uri}\">{page}</a>",

		'first-inactive'          => "",
		'first-inactive-link'     => "",

		'previous'                => "\n\t\t<li>{link}</li>",
		'previous-marker'         => "&laquo;",
		'previous-link'           => "<a href=\"{uri}\" rel=\"prev\">{page}</a>",

		'previous-inactive'       => "\n\t\t<li class=\"disabled\">{link}</li>",
		'previous-inactive-link'  => "<a href=\"#\" rel=\"prev\">{page}</a>",

		'regular'                 => "\n\t\t<li>{link}</li>",
		'regular-link'            => "<a href=\"{uri}\">{page}</a>",

		'active'                  => "\n\t\t<li class=\"active\">{link}</li>",
		'active-link'             => "<a href=\"#\">{page} <span class=\"sr-only\"></span></a>",

		'next'                    => "\n\t\t<li>{link}</li>",
		'next-marker'             => "&raquo;",
		'next-link'               => "<a href=\"{uri}\" rel=\"next\">{page}</a>",

		'next-inactive'           => "\n\t\t<li class=\"disabled\">{link}</li>",
		'next-inactive-link'      => "<a href=\"#\" rel=\"next\">{page}</a>",

		'last'                    => "\n\t\t<li>{link}</li>",
		'last-marker'             => "&raquo;&raquo;",
		'last-link'               => "<a href=\"{uri}\">{page}</a>",

		'last-inactive'           => "",
		'last-inactive-link'      => "",
	),

	// Twitter bootstrap 3.x template
	'bootstrap3_en'                   => array(
		'wrapper'                 => "<ul class=\"pagination\">\n\t{pagination}\n\t</ul>\n",

		'first'                   => "\n\t\t<li>{link}</li>",
		'first-marker'            => "First",
		'first-link'              => "<a href=\"{uri}\">{page}</a>",

		'first-inactive'          => "",
		'first-inactive-link'     => "",

		'previous'                => "\n\t\t<li>{link}</li>",
		'previous-marker'         => "Previous",
		'previous-link'           => "<a href=\"{uri}\" rel=\"prev\">{page}</a>",

		'previous-inactive'       => "\n\t\t<li class=\"disabled\">{link}</li>",
		'previous-inactive-link'  => "<a href=\"#\" rel=\"prev\">{page}</a>",

		'regular'                 => "\n\t\t<li>{link}</li>",
		'regular-link'            => "<a href=\"{uri}\">{page}</a>",

		'active'                  => "\n\t\t<li class=\"active\">{link}</li>",
		'active-link'             => "<a href=\"#\">{page} <span class=\"sr-only\"></span></a>",

		'next'                    => "\n\t\t<li>{link}</li>",
		'next-marker'             => "Next",
		'next-link'               => "<a href=\"{uri}\" rel=\"next\">{page}</a>",

		'next-inactive'           => "\n\t\t<li class=\"disabled\">{link}</li>",
		'next-inactive-link'      => "<a href=\"#\" rel=\"next\">{page}</a>",

		'last'                    => "\n\t\t<li>{link}</li>",
		'last-marker'             => "Last",
		'last-link'               => "<a href=\"{uri}\">{page}</a>",

		'last-inactive'           => "",
		'last-inactive-link'      => "",
	),

	// Twitter bootstrap 3.x template
	'bootstrap3_cn'                   => array(
		'wrapper'                 => "<ul class=\"pagination\">\n\t{pagination}\n\t</ul>\n",

		'first'                   => "\n\t\t<li>{link}</li>",
		'first-marker'            => "首页",
		'first-link'              => "<a href=\"{uri}\">{page}</a>",

		'first-inactive'          => "",
		'first-inactive-link'     => "",

		'previous'                => "\n\t\t<li>{link}</li>",
		'previous-marker'         => "上一页",
		'previous-link'           => "<a href=\"{uri}\" rel=\"prev\">{page}</a>",

		'previous-inactive'       => "\n\t\t<li class=\"disabled\">{link}</li>",
		'previous-inactive-link'  => "<a href=\"#\" rel=\"prev\">{page}</a>",

		'regular'                 => "\n\t\t<li>{link}</li>",
		'regular-link'            => "<a href=\"{uri}\">{page}</a>",

		'active'                  => "\n\t\t<li class=\"active\">{link}</li>",
		'active-link'             => "<a href=\"#\">{page} <span class=\"sr-only\"></span></a>",

		'next'                    => "\n\t\t<li>{link}</li>",
		'next-marker'             => "下一页",
		'next-link'               => "<a href=\"{uri}\" rel=\"next\">{page}</a>",

		'next-inactive'           => "\n\t\t<li class=\"disabled\">{link}</li>",
		'next-inactive-link'      => "<a href=\"#\" rel=\"next\">{page}</a>",

		'last'                    => "\n\t\t<li>{link}</li>",
		'last-marker'             => "末页",
		'last-link'               => "<a href=\"{uri}\">{page}</a>",

		'last-inactive'           => "",
		'last-inactive-link'      => "",
	),
	// Twitter bootstrap 3.x template
	'bootstrap3_cn_ajax'                   => array(
		'wrapper'                 => "<ul class=\"pagination\">\n\t{pagination}\n\t</ul>\n",

		'first'                   => "\n\t\t<li>{link}</li>",
		'first-marker'            => "首页",
		'first-link'              => "<a role=\"page-link\" data-href=\"{uri}\">{page}</a>",

		'first-inactive'          => "",
		'first-inactive-link'     => "",

		'previous'                => "\n\t\t<li>{link}</li>",
		'previous-marker'         => "上一页",
		'previous-link'           => "<a role=\"page-link\" data-href=\"{uri}\" rel=\"prev\">{page}</a>",

		'previous-inactive'       => "\n\t\t<li class=\"disabled\">{link}</li>",
		'previous-inactive-link'  => "<a role=\"page-link\" data-href=\"#\" rel=\"prev\">{page}</a>",

		'regular'                 => "\n\t\t<li>{link}</li>",
		'regular-link'            => "<a role=\"page-link\" data-href=\"{uri}\">{page}</a>",

		'active'                  => "\n\t\t<li class=\"active\">{link}</li>",
		'active-link'             => "<a role=\"page-link\" data-href=\"#\">{page} <span class=\"sr-only\"></span></a>",

		'next'                    => "\n\t\t<li>{link}</li>",
		'next-marker'             => "下一页",
		'next-link'               => "<a role=\"page-link\" data-href=\"{uri}\" rel=\"next\">{page}</a>",

		'next-inactive'           => "\n\t\t<li class=\"disabled\">{link}</li>",
		'next-inactive-link'      => "<a role=\"page-link\" data-href=\"#\" rel=\"next\">{page}</a>",

		'last'                    => "\n\t\t<li>{link}</li>",
		'last-marker'             => "末页",
		'last-link'               => "<a role=\"page-link\" data-href=\"{uri}\">{page}</a>",

		'last-inactive'           => "",
		'last-inactive-link'      => "",
	),

	// Twitter bootstrap 2.x template
	'bootstrap'                   => array(
		'wrapper'                 => "<div class=\"pagination\">\n\t<ul>{pagination}\n\t</ul>\n</div>\n",

		'first'                   => "\n\t\t<li>{link}</li>",
		'first-marker'            => "&laquo;&laquo;",
		'first-link'              => "<a href=\"{uri}\">{page}</a>",

		'first-inactive'          => "",
		'first-inactive-link'     => "",

		'previous'                => "\n\t\t<li>{link}</li>",
		'previous-marker'         => "&laquo;",
		'previous-link'           => "<a href=\"{uri}\" rel=\"prev\">{page}</a>",

		'previous-inactive'       => "\n\t\t<li class=\"disabled\">{link}</li>",
		'previous-inactive-link'  => "<a href=\"#\" rel=\"prev\">{page}</a>",

		'regular'                 => "\n\t\t<li>{link}</li>",
		'regular-link'            => "<a href=\"{uri}\">{page}</a>",

		'active'                  => "\n\t\t<li class=\"active\">{link}</li>",
		'active-link'             => "<a href=\"#\">{page}</a>",

		'next'                    => "\n\t\t<li>{link}</li>",
		'next-marker'             => "&raquo;",
		'next-link'               => "<a href=\"{uri}\" rel=\"next\">{page}</a>",

		'next-inactive'           => "\n\t\t<li class=\"disabled\">{link}</li>",
		'next-inactive-link'      => "<a href=\"#\" rel=\"next\">{page}</a>",

		'last'                    => "\n\t\t<li>{link}</li>",
		'last-marker'             => "&raquo;&raquo;",
		'last-link'               => "<a href=\"{uri}\">{page}</a>",

		'last-inactive'           => "",
		'last-inactive-link'      => "",
	),
	'game360'                   => array(
		
		'wrapper'                 => "<div class=\"fs_fenye\" style=\"width:60%\">{pagination}\n</div>\n",

		
		'first'                   => "{link}",
		'first-marker'            => "",
		'first-link'              => "<a class=\"fs_fy_before\" href=\"{uri}\">首页</a>",

		'first-inactive'          => "{link}",
		'first-inactive-link'     => "<a class=\"fs_fy_before unable\">首页</a>",

		'previous'                => "{link}",
		'previous-marker'         => "",
		'previous-link'           => "<a class=\"fs_fy_before\" href=\"{uri}\">上一页</a>",

		'previous-inactive'       => "<a class=\"fs_fy_before unable\">上一页</a>",
		'previous-inactive-link'  => "",

		'regular'                 => "{link}",
		'regular-link'            => "<a href=\"{uri}\">{page}</a>",

		'active'                  => "<span>{link}</span>",
		'active-link'             => "<a class=\"fs_fy_active\" href=\"#\">{page}</a>",

		'next'                    => "{link}",
		'next-marker'             => "",
		'next-link'               => "<a class=\"fs_fy_next\" href=\"{uri}\">下一页</a>",

		'next-inactive'           => "{link}",
		'next-inactive-link'      => "<a class=\"fs_fy_next unable\" href=\"{uri}\">下一页</a>",

		'last'                    => "{link}",
		'last-marker'             => "",
		'last-link'               => "<a class=\"fs_fy_last\" href=\"{uri}\">末页</a>",

		'last-inactive'           => "{link}",
		'last-inactive-link'      => "<a class=\"fs_fy_last unable\" href=\"{uri}\">末页</a>",
	),

	// video template
	'video'                   => array(
		'wrapper'                 => "<div id=\"tnt_pagination\">\n\t{pagination}\n\t</div>\n",

		'first'                   => "{link}",
		'first-marker'            => "",
		'first-link'              => "<a class=\"first\" href=\"{uri}\">首页</a>",

		'first-inactive'          => "{link}",
		'first-inactive-link'     => "<span class=\"first disabled_tnt_pagination\" href=\"{uri}\">首页</span>",

		'previous'                => "{link}",
		'previous-marker'         => "",
		'previous-link'           => "<a class=\"previous\" href=\"{uri}\" rel=\"prev\">上页</a>",

		'previous-inactive'       => "<span class=\"previous disabled_tnt_pagination\" href=\"{uri}\" rel=\"prev\">上页</span>",
		'previous-inactive-link'  => "",

		'regular'                 => "{link}",
		'regular-link'            => "<a class=\"page\" href=\"{uri}\">{page}</a>",

		'active'                  => "<span class=\"page zzjs\">{link}</span>",
		'active-link'             => "{page}",

		'next'                    => "{link}",
		'next-marker'             => "",
		'next-link'               => "<a class=\"next\" href=\"{uri}\" rel=\"next\">下页</a>",

		'next-inactive'           => "<span class=\"next disabled_tnt_pagination\">下页</span>",
		'next-inactive-link'      => "{page}",

		'last'                    => "{link}",
		'last-marker'             => "",
		'last-link'               => "<a class=\"last disabled_tnt_pagination\" href=\"{uri}\">尾页</a>",

		'last-inactive'           => "{link}",
		'last-inactive-link'      => "<span class=\"last disabled_tnt_pagination\" href=\"{uri}\">尾页</span>",
	),
	// 博洛尼 template
	'decorate'                    => array(
		'wrapper'                 => "<div class=\"page\">\n\t{pagination}\n\t</div>\n",

		'first'                   => "\n\t\t{link}",
		'first-marker'            => "首页",
		'first-link'              => "<a class=\"page_link\" href=\"{uri}\">{page}</a>",

		'first-inactive'          => "",
		'first-inactive-link'     => "<a class=\"page_hover\" href=\"{uri}\">{page}</a>",

		'previous'                => "\n\t\t{link}",
		'previous-marker'         => "上一页",
		'previous-link'           => "<a class=\"page_link\" href=\"{uri}\" rel=\"prev\">{page}</a>",

		'previous-inactive'       => "\n\t\t{link}",
		'previous-inactive-link'  => "<a class=\"page_hover\" href=\"#\" rel=\"prev\">{page}</a>",

		'regular'                 => "\n\t\t{link}",
		'regular-link'            => "<a class=\"page_link\" href=\"{uri}\">{page}</a>",

		'active'                  => "\n\t\t{link}",
		'active-link'             => "<a class=\"page_hover\" href=\"#\">{page} <span class=\"sr-only\"></span></a>",

		'next'                    => "\n\t\t{link}",
		'next-marker'             => "下一页",
		'next-link'               => "<a class=\"page_link\" href=\"{uri}\" clas=\"down_next\" rel=\"next\">{page}</a>",

		'next-inactive'           => "\n\t\t<li class=\"disabled\">{link}</li>",
		'next-inactive-link'      => "<a class=\"page_hover\" href=\"#\" class=\"down_next\" rel=\"next\">{page}</a>",

		'last'                    => "\n\t\t{link}",
		'last-marker'             => "末页",
		'last-link'               => "<a class=\"page_link\" href=\"{uri}\">{page}</a>",

		'last-inactive'           => "",
		'last-inactive-link'      => "<a class=\"page_hover\" href=\"#\">{page}</a>",
	),
	'yd1'                     => array(
		'wrapper'                 => "<div class=\"pagination\">\n\t{pagination}\n</div>\n",

		'first'                   => "<span class=\"first\">\n\t{link}\n</span>\n",
		'first-marker'            => "&laquo;&laquo;",
		'first-link'              => "\t\t<a href=\"{uri}\">{page}</a>\n",

		'first-inactive'          => "",
		'first-inactive-link'     => "",

		'previous'                => "<span class=\"previous\">\n\t{link}\n</span>\n",
		'previous-marker'         => "&laquo;",
		'previous-link'           => "\t\t<a href=\"{uri}\" rel=\"prev\">{page}</a>\n",

		'previous-inactive'       => "<span class=\"previous-inactive\">\n\t{link}\n</span>\n",
		'previous-inactive-link'  => "\t\t<a href=\"#\" rel=\"prev\">{page}</a>\n",

		'regular'                 => "<span>\n\t{link}\n</span>\n",
		'regular-link'            => "\t\t<a href=\"{uri}\">{page}</a>\n",

		'active'                  => "<span class=\"active\">\n\t{link}\n</span>\n",
		'active-link'             => "\t\t<a href=\"#\">{page}</a>\n",

		'next'                    => "<span class=\"next\">\n\t{link}\n</span>\n",
		'next-marker'            => "&raquo;",
		'next-link'               => "\t\t<a href=\"{uri}\" rel=\"next\">{page}</a>\n",

		'next-inactive'           => "<span class=\"next-inactive\">\n\t{link}\n</span>\n",
		'next-inactive-link'      => "\t\t<a href=\"#\" rel=\"next\">{page}</a>\n",

		'last'                    => "<span class=\"last\">\n\t{link}\n</span>\n",
		'last-marker'             => "&raquo;&raquo;",
		'last-link'               => "\t\t<a href=\"{uri}\">{page}</a>\n",

		'last-inactive'           => "",
		'last-inactive-link'      => "",
	),

	'yd'                     => array(
		'wrapper'                 => "<div class=\"fy\">\n\t{pagination}\n</div>\n",

		'first'                   => "",
		'first-marker'            => "",
		'first-link'              => "",

		'first-inactive'          => "",
		'first-inactive-link'     => "",

		'previous'                => "<span class=\"previous\">\n\t{link}\n</span>\n",
		'previous-marker'         => "<img src=\"/assets/web/images/fy_l.png\">",
		'previous-link'           => "\t\t<a href=\"{uri}\" rel=\"prev\">{page}</a>\n",

		'previous-inactive'       => "<span class=\"previous-inactive\">\n\t{link}\n</span>\n",
		'previous-inactive-link'  => "\t\t<a href=\"#\" rel=\"prev\"><img src=\"/assets/web/images/fy_l.png\">{page}</a>\n",

		'regular'                 => "<span>\n\t{link}\n</span>\n",
		'regular-link'            => "\t\t<a href=\"{uri}\">{page}</a>\n",

		'active'                  => "<span class=\"fy_active\">\n\t{link}\n</span>\n",
		'active-link'             => "\t\t<a href=\"#\">{page}</a>\n",

		'next'                    => "<span class=\"next\">\n\t{link}\n</span>\n",
		'next-marker'            => "<img src=\"/assets/web/images/fy.png\">",
		'next-link'               => "\t\t<a href=\"{uri}\" rel=\"next\">{page}</a>\n",

		'next-inactive'           => "<span class=\"next-inactive\">\n\t{link}\n</span>\n",
		'next-inactive-link'      => "\t\t<a href=\"#\" rel=\"next\">{page}</a>\n",

		'last'                    => "",
		'last-marker'             => "",
		'last-link'               => "",

		'last-inactive'           => "",
		'last-inactive-link'      => "",
	),

	'wk'                     => array(
		'wrapper'                 => "<div class=\"paper\">\n\t{pagination}\n</div>\n",

		'first'                   => "",
		'first-marker'            => "",
		'first-link'              => "",

		'first-inactive'          => "",
		'first-inactive-link'     => "",

		'previous'                => "<span class=\"previous\">\n\t{link}\n</span>\n",
		'previous-marker'         => "",
		'previous-link'           => "\t\t<a href=\"{uri}\" rel=\"prev\">上一页</a>\n",

		'previous-inactive'       => "<span class=\"previous-inactive\">\n\t{link}\n</span>\n",
		'previous-inactive-link'  => "\t\t<a href=\"#\" rel=\"prev\">{page}</a>\n",

		'regular'                 => "<span>\n\t{link}\n</span>\n",
		'regular-link'            => "\t\t<a href=\"{uri}\">{page}</a>\n",

		'active'                  => "<span>\n\t{link}\n</span>\n",
		'active-link'             => "\t\t<a class=\"current\" href=\"#\">{page}</a>\n",

		'next'                    => "<span class=\"next\">\n\t{link}\n</span>\n",
		'next-marker'            => "",
		'next-link'               => "\t\t<a href=\"{uri}\" rel=\"next\">下一页</a>\n",

		'next-inactive'           => "<span class=\"next-inactive\">\n\t{link}\n</span>\n",
		'next-inactive-link'      => "\t\t<a href=\"{uri}\" rel=\"next\">{page}</a>\n",

		'last'                    => "",
		'last-marker'             => "",
		'last-link'               => "",

		'last-inactive'           => "",
		'last-inactive-link'      => "",
	),
	'chinaMusic'                  => array(
		'wrapper'                 => "<ul class=\"pagination pagination-sm\">\n\t{pagination}\n</ul>\n",

		'first'                   => "",
		'first-marker'            => "",
		'first-link'              => "",

		'first-inactive'          => "",
		'first-inactive-link'     => "",

		'previous'                => "<li>\n\t{link}\n</li>\n",
		'previous-marker'         => "&laquo;",
		'previous-link'           => "<a href=\"{uri}\" title=\"上一页\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a>",//上一页

		'previous-inactive'       => "",
		'previous-inactive-link'  => "",

		'regular'                 => "<li>\n\t{link}\n</li>\n",
		'regular-link'            => "<a href=\"{uri}\">{page}</a>",

		'active'                  => "<li>\n\t{link}\n</li>\n",
		'active-link'             => "<a href=\"{uri}\" class=\"active\">{page}</a>",//分页

		'next'                    => "<li>\n\t{link}\n</li>",//下一页
		'next-marker'             => "&raquo;",
		'next-link'               => "<a href=\"{uri}\" title=\"下一页\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a>",//下一页

		'next-inactive'           => "",
		'next-inactive-link'      => "",

		'last'                    => "",
		'last-marker'             => "",
		'last-link'               => "",

		'last-inactive'           => "",
		'last-inactive-link'      => "",
	),
);
