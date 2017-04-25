<?php
/*
Plugin Name: SiteOrigin Bootstrap Grid
Plugin URI:  https://github.com/dolatabadi/siteorigin-bootstrap-grid
Description: Bootstrap grid for Page Builder by SiteOrigin
Version: 1.0.0
Author: Dolatabadi
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * Define constants
 */
define( 'SO_BOOTSTRAP_GRID_VERSION', '1.0.0' );
define( 'SO_BOOTSTRAP_GRID_DIR', plugin_dir_path( __FILE__ ) );
define( 'SO_BOOTSTRAP_GRID_URL', plugin_dir_url( __FILE__ ) );
define( 'SO_PANELS_BOOTSTRAP_BASE_FILE', __FILE__ );
define( 'SO_PANELS_BOOTSTRAP_URL', plugin_dir_url( __FILE__ ) );

/**
 * Load the main files
 */
function so_bootstrap_grid_plugins_loaded() {
  require_once SO_BOOTSTRAP_GRID_DIR . 'so-panels-bootstrap.php';
}

add_action( 'plugins_loaded', 'so_bootstrap_grid_plugins_loaded' );

/**
 * Deactivate the plugin if SiteOrigin panels is not installed
 */
function maybe_self_deactivate() {
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  if ( ! is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    deactivate_plugins( plugin_basename( __FILE__ ) );
    add_action( 'admin_notices', 'self_deactivate_notice' );
  }
}

add_action( 'plugins_loaded', 'maybe_self_deactivate' );

/**
 * Display the error message when plugin is deactivate due to dependency check
 */
function self_deactivate_notice() {
  echo '<div class="error"><p>' . __( 'SO Panels Bootstrap Plugin has deactivated itself because <a href="https://wordpress.org/plugins/siteorigin-panels/">Page Builder by SiteOrigin</a> is no longer active.', 'my-theme' ) . '</p></div>';
}
