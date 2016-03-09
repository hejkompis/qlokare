<?php 

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



// Creates Assigment Custom Post Type

function Assignments_init() {
    $args = array(
      'label' => 'Uppgifter',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => array('slug' => 'assignments'),
        'query_var' => true,
        'menu_icon' => 'dashicons-format-aside',
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
    register_post_type( 'assignments', $args );
}
add_action( 'init', 'Assignments_init' );



?>