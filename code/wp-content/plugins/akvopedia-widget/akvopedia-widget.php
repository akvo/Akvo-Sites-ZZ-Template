<?php
/**
 * Plugin Name: akvopedia-widget
 * Plugin URI: https://github.com/akvo/
 * Description: A widget for displaying akvopedia Articles.
 * Version: 1.1
 * Author: Andreas Jonsson
 * Author URI: http://kreablo.se
 * License: AGPL3
 * Text Domain: data-feed
 */

require_once __DIR__ . '/autoload.php';

register_activation_hook( __FILE__, 'AkvopediaWidget\Plugin\PluginManagement::activation' );
register_deactivation_hook( __FILE__, 'AkvopediaWidget\Plugin\PluginManagement::deactivation' );
register_uninstall_hook( __FILE__, 'AkvopediaWidget\Plugin\PluginManagement::uninstall' );

define( 'AKVOPEDIA_WIDGET_PLUGIN_DIR', __DIR__ );
define( 'AKVOPEDIA_WIDGET_VERSION', '1.1' );

foreach ( array( 'wp_enqueue_scripts', 'widgets_init', 'init' ) as $a ) {
	add_action( $a, array( 'AkvopediaWidget\Plugin\PluginManagement', $a ) );
}
