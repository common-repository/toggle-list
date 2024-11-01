<?php
/*
Plugin Name: Toggle List
Plugin URI: http://prettywebthings.com/wordpress-plugins/
Description: Insert an open/close toggle button on any list item. Simple list toggler has an easy to use editor button to insert toggle buttons.
Version: 0.1
Author: Pretty Web Things
Author URI: http://prettywebthings.com/ 
License: GPL v2
*/
/**
 * Copyright (c) 2012 Soma Design. All rights reserved.
 *
 * Released under the GPL v2 license
 * http://www.opensource.org/licenses/gpl-2.0.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * **********************************************************************
 */

if( !class_exists( 'SimpleTreeToggle' ) ) {

	add_action( 'init', 'init_toggle_list' );
	function init_toggle_list() {
		new SimpleTreeToggle();
	}


	class SimpleTreeToggle {

			function __construct() {

				//add buttons
				add_action('admin_head', array( $this, 'mce_custom' ) );

				//add styles
				add_filter( 'mce_css', array( $this, 'plugin_mce_css' ) );

				//frontend scripts
				add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );

				//admin scripts
				add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

			}

			function frontend_scripts() {
				
				wp_register_script( 'toggle-list', plugins_url( 'js/toggle-list.min.js', __FILE__ ), array( 'jquery' ), '0.1', true );
				wp_enqueue_script('toggle-list');

				wp_enqueue_style( 'toggle-list', plugins_url( 'css/style.min.css', __FILE__ ), array(), '0.1' );
				wp_enqueue_style('toggle-list');
			}

			function admin_scripts() {
				wp_enqueue_style( 'toggle-list', plugins_url( 'css/admin.min.css', __FILE__ ), array(), '0.1' );
				wp_enqueue_style('toggle-list');
			}

			function plugin_mce_css( $mce_css ) {
				if ( ! empty( $mce_css ) )
					$mce_css .= ',';

				$mce_css .= plugins_url( 'css/admin.min.css', __FILE__ );

				return $mce_css;
			}

			function mce_custom() {
				// check user permissions
				if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) :
					return;
				endif;
				// check if WYSIWYG is enabled
				if ( 'true' == get_user_option( 'rich_editing' ) ) :
					add_filter( 'mce_external_plugins', array( $this, 'mce_plugin' ) );
					add_filter( 'mce_buttons_2', array( $this, 'mce_button' ) );
				endif;
			}

			function mce_plugin( $plugin_array ) {
				$plugin_array['simpletree'] = plugins_url( 'js/wp-editor.min.js', __FILE__ );
				return $plugin_array;
			}

			function mce_button( $buttons ) {
				array_push( $buttons, 'simpletree' );
				return $buttons;
			}

	}
}
?>