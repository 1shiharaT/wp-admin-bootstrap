<?php
/**
 * @package WP Admin Bootstrap
 */
/*
Plugin Name: WP Admin Bootstrap
Plugin URI: http://web-layman.com/
Description: Bootstrap based css framework for WordPress
Version: 0.0.1
Author: 1shiharaT
Author URI: http://web-layman.com
License: GPLv2 or later
Text Domain: wp-admin-bootstrap
*/

require_once ( 'functions.php' );

class WP_Admin_Bootstrap {

	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ), 10, 2 );
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'settings_init' ) );
	}

	public function scripts( $hook ) {
		// bootstrap
		wp_enqueue_style( 'wpab_bootstrap_css', plugins_url( 'assets/css/wpa-bootstrap.css', __FILE__ ), array(), false, false );
		// icheck
		wp_enqueue_style( 'wpab_bootstrap_icheck', plugins_url( 'assets/components/icheck/skins/square/green.css', __FILE__ ), array(), false, false );

		// bootstrap
		wp_enqueue_script( 'wpab_bootstrap_js', plugins_url( 'assets/js/bootstrap.min.js', __FILE__ ), array( 'jquery' ), false, false );
		// icheck
		wp_enqueue_script( 'wpab_bootstrap_icheck', plugins_url( 'assets/components/icheck/icheck.min.js', __FILE__ ), array( 'jquery' ), false, false );
		wp_enqueue_script( 'wpab_bootstrap_nortify', plugins_url( 'assets/components/remarkable-bootstrap-notify/bootstrap-notify.min.js', __FILE__ ), array( 'jquery' ), false, false );

	}

	public function add_admin_menu() {
		add_options_page( 'wp-admin-bootstrap', 'WP Admin Bootstrap', 'manage_options', 'wp-admin-bootstrap', array(
			$this,
			'options_page'
		) );
	}

	public function settings_init() {

		register_setting( 'pluginPage', 'wpab_settings' );

		add_settings_section(
			'wpab_pluginPage_section',
			__( '', 'wp-admin-bootstrap' ),
			'',
			'pluginPage'
		);

	}

	public function options_page() { ?>
		<div class="wpa">
			<div class="container">
				<?php wpa_button( array( 'tag' => 'button','href' => 'test', 'text' => 'test', ) ); ?>
				<h2><?php _e( 'WP Admin Bootstrap', 'wp-admin-bootstrap' ) ?></h2>
				<p><?php _e( 'Feautured : ', 'wp-admin-bootstrap' ) ?></p>
				<p><a href="http://fronteed.com/iCheck/" target="_blank"><?php _e( 'iCheck' ) ?></a></p>
				<p><a href="http://bootstrap-growl.remabledesigns.com/" target="_blank"><?php _e( 'Bootstrap Notify' ) ?></a></p>
				<h3><?php _e( 'Use' ) ?></h3>
				<p>
					Please be enclosed in <code>".wpa"</code>
					<pre><code><?php echo htmlspecialchars( '<div class="wpa"> <!-- your contents --> </div>' ) ?></code></pre></p>
				<?php
				do_settings_sections( 'pluginPage' );
				include 'templates/view.php';
				?>
			</div>
		</div>
	<?php

	}
}




new WP_Admin_Bootstrap();
