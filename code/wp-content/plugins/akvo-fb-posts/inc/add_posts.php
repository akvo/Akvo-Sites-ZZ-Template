<?php


/**
 * Register a fb_post post type.
 */


if ( ! function_exists('Fb_post'));

    add_action('init', 'Fb_post');

    function Fb_post()
    {
        $labels = array(
            'name'                          => _x('Facebook posts', 'post type general name', 'Fb posts'),
            'singular_name'                 => _x('Fb post', 'post type singular name', 'Fb posts'),
            'menu_name'                     => _x('Fb posts', 'admin menu', 'Fb posts'),
            'submenu_name'                  => _X('Fb_posts', 'Fb_posts', 'Settings', 'admin menu', 'Fb posts'),
            'name_admin_bar'                => _x('Fb_post', 'add new on admin bar', 'Fb posts'),
            'add_new'                       => _x('Add New', 'Fb_post', 'Fb posts'),
            'add_new_item'                  => __('Add New Fb_post', 'Fb posts'),
            'new_item'                      => __('New Fb_post', 'Fb posts'),
            'edit_item'                     => __('Edit Fb_post', 'Fb posts'),
            'view_item'                     => __('View Fb_post', 'Fb posts'),
            'all_items'                     => __('Fb posts', 'Fb posts'),
            'search_items'                  => __('Search posts', 'Fb posts'),
            'parent_item_colon'             => __('Parent Fb-posts:', 'Fb posts'),
            'not_found'                     => __('No Fb-posts found.', 'Fb posts'),
            'not_found_in_trash'            => __('No Fb-posts found in Trash.', 'Fb posts'),
            'featured_image'                => __('Featured Image', 'Fb posts'),
            'set_featured_image'            => __('Set featured image', 'Fb posts'),
            'remove_featured_image'         => __('Remove featured image', 'Fb posts'),
            'use_featured_image'            => __('Use as featured image', 'Fb posts'),
            //'insert_into_item'            => __('Insert into Fb_post', 'Fb posts'),
            'uploaded_to_this_item'         => __('Uploaded to this item', 'Fb posts'),
            'items_list'                    => __('Items list', 'Fb posts'),
            'items_list_navigation'         => __('Items list navigation', 'Fb posts'),
            'filter_items_list'             => __('Filter items list', 'Fb posts'),
        );

        $args = array(
            'show_in_rest'                  => true, // Enable the REST API
            //'post_type'                   => array ('post','Fb_post'),
            'posts_per_page'                => 10,
            'labels'                        => $labels,
            'description'                   => __('Description.', 'Fb-posts'),
            'public'                        => true,
            'publicly_queryable'            => true,
            'show_ui'                       => true,
            'show_in_menu'                  => true,
            'show_in_nav_menus'             => true,
            'can_export'                    => true,
            'exclude_from_search'           => true,
            'menu_icon'                     => 'dashicons-facebook', // Set icon
            'query_var'                     => true,
            'rewrite'                       => array('slug' => 'Fb_post'),
            'capability_type'               => 'post',
            'has_archive'                   => true,
            'hierarchical'                  => false,
            'menu_position'                 => null,
            'supports'                      => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
            'taxonomies'                    => array('category', 'post_tag'),

        );
        register_post_type('Fb_post', $args);
    }


// Show posts of post types on home page
function add_FB_post_types_to_query( $query ) {
    if ( is_admin() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'Fb_post' ) );
    return $query;
}
add_action( 'pre_get_posts', 'add_FB_post_types_to_query' );









