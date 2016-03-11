<?php 

function my_home_category( $query ) 
{ if ( $query->is_home() && $query->is_main_query() ) { $query->set( 'cat', '15'); } } 
add_action( 'pre_get_posts', 'my_home_category' );

/*function user_logged_in() {
    $user = wp_get_current_user();
 
    return $user->exists();
}/*/



// Creates Courses Custom Post Type

function Courses_init() {
    $args = array(
      'label' => 'Kurser',
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => array('slug' => 'course'),
        'query_var' => true,
        'menu_icon' => 'dashicons-book',
        
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',)
        );
    register_post_type( 'courses', $args );
}
add_action( 'init', 'Courses_init' );






?>