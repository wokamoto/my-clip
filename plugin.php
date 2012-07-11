<?php
/*
Plugin Name: My Clip
Plugin URI: 
Description: 
Author: wokamoto
Version: 0.0.1
Author URI: http://dogmap.jp/

License:
 Released under the GPL license
  http://www.gnu.org/copyleft/gpl.html

  Copyright 2012 (email : wokamoto1973@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
class my_clip {
	const COOKIE_KEY = 'my_clip';
	const COOKIE_EXPIRES = 7;

	function __construct() {
		add_action('plugins_loaded', array(&$this, 'plugins_loaded'));
	}

	public function plugins_loaded() {
		if ( !is_admin() ) {
			add_action( 'content', array(&$this, 'add_clip') );
			add_action( 'wp_enqueue_scripts', array(&$this,'add_scripts') );
			add_action( 'wp_footer', array(&$this,'footer_scripts') );
		}
	}

	public function add_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery.cookie', plugins_url('/js/jquery.cookie.js', __FILE__), array('jquery'), '1.1', true );
	}
	
	public function footer_scripts() {
        echo "<script>\n";
        echo "jQuery(function($){\n";
        echo "\n});\n";
        echo "</script>\n";
	}
	
	public function add_clip($content) {
		$id = get_the_ID();
		$icon = sprintf(
			'<div class="clip_icon"><img src="%s" width="32" height="28" id="clip-%d"></div>',
			plugins_url('/images/clip_1.png', __FILE__),
			$id
			);
		return $icon . $content;
	}
}

New my_clip();