<?php

namespace AkvopediaWidget\Post;

use AkvopediaWidget\Gadget\AkvopediaGadget;

class AkvopediaPost {

	public static function register()
	{
		register_post_type( 'akvopedia',
			array(
				'labels' => array(
					'name' => __( 'Akvopedia' ),
					'singular_name' => __( 'Akvopedia' )
				),
				'public' => true,
				'has_archive' => true,
				'menu_position' => 20,
				'menu_icon' => 'dashicons-book-alt',
				'supports' => array(
					'title',
					'excerpt',
				),
			)
		);
		add_action( 'the_content', 'AkvopediaWidget\Post\AkvopediaPost::inject_post_content' );
	}

	public static function inject_post_content( $content ) {
		global $post;
		if ($post->post_type != 'akvopedia') {
			return $content;
		}
		$title_id = 'akvopedia-title-' . $post->ID;
		$div_id = 'akvopedia-' . $post->ID;
		$gadget = new AkvopediaGadget( $post->post_title, $title_id, $div_id, array( 'scrollToElement' => 'body' ) );
		return $gadget->getRendered();
	}
}