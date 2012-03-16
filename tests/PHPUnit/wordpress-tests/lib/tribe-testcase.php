<?php
class Tribe_WP_UnitTestCase extends WP_UnitTestCase {
	var $plugin_slugs = array();
	var $default_plugin_slug = 'the-events-calendar';
	
	function setUp() {
		parent::setUp();
		$this->activate_tested_plugins();
	}
	
	function activate_tested_plugins() {
		require_once ABSPATH . '/wp-admin/includes/plugin.php';
		if ( !$this->plugin_slugs ) {
			if ( file_exists( WP_PLUGIN_DIR . '/' . $this->default_plugin_slug . '/' .$this->default_plugin_slug . '.php' ) )
				activate_plugin( $this->default_plugin_slug . '/' . $this->default_plugin_slug . '.php'  );
			return;
		}
		foreach( $this->plugin_slugs as $plugin_slug ) {
			if ( file_exists( WP_PLUGIN_DIR . '/' . $plugin_slug . '.php' ) )
				activate_plugin( $plugin_slug . '.php' );
			elseif ( file_exists( WP_PLUGIN_DIR . '/' . $plugin_slug . '/' . $plugin_slug . '.php' ) )
				activate_plugin( $plugin_slug . '/' . $plugin_slug . '.php'  );
			else 
				throw new WP_Tests_Exception( "Couldn't find a plugin with slug $plugin_slug" );
		}
	}
}