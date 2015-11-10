<?php

namespace AkvopediaWidget\Plugin;

use AkvopediaWidget\Post\AkvopediaPost;

class PluginManagement
{
	public static function activation()
	{
	}

	public static function deactivation()
	{
	}

	public static function uninstall()
	{
	}

	public static function widgets_init()
	{
		\register_widget( 'AkvopediaWidget\Widget\AkvopediaWidget' );
		AkvopediaPost::register();
	}

	public static function wp_enqueue_scripts()
	{
		\wp_enqueue_script( 'akvopedia-gadget', 'https://akvopedia.org/resources/akvopedia-gadget/akvopedia-gadget.js', array( 'jquery' ));
		\wp_enqueue_style( 'akvopedia-gadget', plugins_url( '/css/style.css', AKVOPEDIA_WIDGET_PLUGIN_DIR . '/akvopedia-widget.php'));
	}

}

