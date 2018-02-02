<?php

namespace AkvopediaWidget\Plugin;

use AkvopediaWidget\Post\AkvopediaPost;

class PluginManagement
{
	public static function activation()
	{
		\flush_rewrite_rules();
	}

	public static function deactivation()
	{
		\flush_rewrite_rules();
	}

	public static function uninstall()
	{
	}

	public static function widgets_init()
	{
		\register_widget( 'AkvopediaWidget\Widget\AkvopediaWidget' );
	}

	public static function init()
	{
		AkvopediaPost::register();
	}

	public static function wp_enqueue_scripts()
	{
		\wp_enqueue_style( 'akvopedia-gadget', plugins_url( '/css/style.css', AKVOPEDIA_WIDGET_PLUGIN_DIR . '/akvopedia-widget.php'), array(), AKVOPEDIA_WIDGET_VERSION );
	}

}

