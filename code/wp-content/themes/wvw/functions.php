<?php
	add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
   wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'), '1.9.1');

}
// Allow iframe tags within editor
function allow_multisite_tags( $multisite_tags ){
    $multisite_tags['iframe'] = array(
        'src' => true,
        'width' => true,
        'height' => true,
        'align' => true,
        'class' => true,
        'name' => true,
        'id' => true,
        'frameborder' => true,
        'seamless' => true,
        'srcdoc' => true,
        'sandbox' => true,
        'allowfullscreen' => true
    );
    return $multisite_tags;
}
add_filter('wp_kses_allowed_html','allow_multisite_tags', 1);