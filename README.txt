=== Front End Sitemap ===
Contributors: moabi
Donate link: https://www.lyra-network.com
Tags: sitemap
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: v1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A small plugin to embed a page sitemap
use :
    if ( shortcode_exists( 'frontend-sitemap' ) ) {
				echo do_shortcode('[frontend-sitemap type="page" wpmenu="true"]');
	}

or :
[frontend-sitemap type="page" wpmenu="false"]

## type="page"
=> type of post

## wpmenu="false"
change wrapper class
'pure-menu-list':'fes-wrapper'