<?php


function my_login_redirect( $url, $request, $user ){
    if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
        if( $user->has_cap( 'admin','author' ) ) {
            $url = admin_url();
        } else {
            $url = home_url('/index.php/');
        }
    }
    return $url;
}
add_filter('login_redirect', 'my_login_redirect', 10, 3 );





    /**
     *
     * CUSTOM POST TYPE: COURSES
     *
     */

	/**
     * Metabox för att koppla lärare till kurs.
     *
     * Funktion som skapar en metabox i custom post type "Course" där vi ges möjlighet att lägga till
     * kursansvarig lärare.
     * Hör ihop med funktionerna "meta_box_for_courses" och "special_save_cpt_course"
     */

    function my_custom_post_courses() {
        register_post_type( 'course', $args ); 
        $labels = array(
        'name' => 'courses', 'post type general name',
        'singular_name' => 'course', 'post type singular name',
        'add_new' => 'Add New', 'course',
        'add_new_item' => 'Add New course',
        'edit_item' => 'Edit course',
        'new_item' => 'New course',
        'all_items' => 'All course',
        'view_item' => 'View course',
        'search_items' => 'Search course',
        'not_found' => 'No courses found',
        'not_found_in_trash' => 'No courses found in the Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'courses'
        );
        $args = array(
        'labels' => $labels,
        'description' => 'Holds our courses and course specific data',
        'public' => true,
        'menu_position' => 20,
        'show_in_menu' => true,
        'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'author','page-attributes' ),
        'has_archive' => true,
        'register_meta_box_cb' => 'add_course_metaboxes'
        );
      
        }
    add_action( 'init', 'my_custom_post_courses');


	function add_meta_box_to_courses() {
 
        add_meta_box(
            'course-options',
            'Options',
            'meta_box_for_courses',
            'course',
            'normal',
            'core'
        );
 
    }

    /**
     * Funktionen som läser in den specifika fil som ligger i metaboxen. Filen innehåller HTML och PHP som 
     * skriver ut en select-box med "custom post type"-lärare
     *
     */

	function meta_box_for_courses($post) {
        
        require_once get_template_directory().'/partials/cpt-course-meta-box.php';
    
    }

    add_action('add_meta_boxes', 'add_meta_box_to_courses');

    /**
     * Extra sparfunktion till custom post type "Course" som sparar ansvarig lärare. Körs i samband med att man sparar en post.
     *
     */

    function special_save_cpt_course($post_id, $post, $update) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times

		//if ( !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) ) { 	return; }

		// If not correct slug

		if('course' != $post->post_type) {
			return;
		}

		// Save metadata

		if ( isset( $_POST['cpt_course_teacher'] ) ) {
         	update_post_meta( 
         		$post_id, 
         		'cpt_course_teacher', 
         		sanitize_text_field( $_POST['cpt_course_teacher'] ) 
         	);
     	}

	}

	add_action('save_post', 'special_save_cpt_course', 10, 3);

    
    /**
     *
     * CUSTOM POST TYPE: CLASS
     *
     */

    /**
     * Metabox för att koppla lärare till kurs.
     *
     * Funktion som skapar en metabox i custom post type "Course" där vi ges möjlighet att lägga till
     * kursansvarig lärare.
     * Hör ihop med funktionerna "meta_box_for_courses" och "special_save_cpt_course"
     */

    function my_custom_post_class() {
        register_post_type( 'class', $args ); 
        $labels = array(
        'name' => 'Assignments', 'post type general name',
        'singular_name' => 'class', 'post type singular name',
        'add_new' => 'Add New', 'class',
        'add_new_item' => 'Add New class',
        'edit_item' => 'Edit class',
        'new_item' => 'New class',
        'all_items' => 'All class',
        'view_item' => 'View class',
        'search_items' => 'Search class',
        'not_found' => 'No assignments found',
        'not_found_in_trash' => 'No assignments found in the Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Assignments'
        );
        $args = array(
        'labels' => $labels,
        'description' => 'Holds our classes and class specific data',
        'public' => true,
        'menu_position' => 21,
        'show_in_menu' => true,
        'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'author','page-attributes' ),
        'has_archive' => true,
        'register_meta_box_cb' => 'add_class_metaboxes'
        );
      
        }
        add_action( 'init', 'my_custom_post_class');

    function add_meta_box_to_class() {
 
        add_meta_box(
            'class-options',
            'Kurser',
            'meta_box_for_class',
            'class',
            'normal',
            'core'
        );
 
    }

    /**
     * Funktionen som läser in den specifika fil som ligger i metaboxen. Filen innehåller HTML och PHP som 
     * skriver ut en select-box med "custom post type"-lärare
     *
     */

    function meta_box_for_class($post) {
        
        require_once get_template_directory().'/partials/cpt-class-meta-box.php';
    
    }

    add_action('add_meta_boxes', 'add_meta_box_to_class');

    /**
     * Extra sparfunktion till custom post type "Course" som sparar ansvarig lärare. Körs i samband med att man sparar en post.
     *
     */

    function special_save_cpt_class($post_id, $post, $update) {

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times

        //if ( !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) ) {    return; }

        // If not correct slug

        if('class' != $post->post_type) {
            return;
        }

        // Save metadata

        if ( isset( $_POST['cpt_class_courses'] ) ) {

            delete_post_meta($post_id, 'cpt_class_courses');
            
            foreach($_POST['cpt_class_courses'] as $course) {

                add_post_meta( 
                    $post_id, 
                    'cpt_class_courses', 
                    sanitize_text_field( $course ) 
                );

            }

        }

    }

    add_action('save_post', 'special_save_cpt_class', 10, 3);






    /**
     *
     * CUSTOM POST TYPE: ASSIGNMENT
     *
     */

    /**
     * Metabox för att koppla kurs till uppgifter.
     *
     * Funktion som skapar en metabox i custom post type "assignment" där vi ges möjlighet att lägga till
     * kurs.
     * Hör ihop med funktionerna "meta_box_for_assignments" och "special_save_cpt_assignment"
     */

    function my_custom_post_assignment() {
        register_post_type( 'class', $args ); 
        $labels = array(
        'name' => 'Assignments', 'post type general name',
        'singular_name' => 'Assignment', 'post type singular name',
        'add_new' => 'Add New', 'assignment',
        'add_new_item' => 'Add New Assignment',
        'edit_item' => 'Edit Assignment',
        'new_item' => 'New Assignment',
        'all_items' => 'All Assignments',
        'view_item' => 'View Assignment',
        'search_items' => 'Search Assignments',
        'not_found' => 'No assignments found',
        'not_found_in_trash' => 'No assignments found in the Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Assignments'
        );
        $args = array(
        'labels' => $labels,
        'description' => 'Holds our assignments and assignment specific data',
        'public' => true,
        'menu_position' => 20,
        'show_in_menu' => true,
        'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'author','page-attributes' ),
        'has_archive' => true,
        'register_meta_box_cb' => 'add_assignment_metaboxes'
        );
      
        }
    add_action( 'init', 'my_custom_post_assignment');




    function add_meta_box_to_assignment() {
 
        add_meta_box(
            'assignment-options',
            'Uppgifter',
            'meta_box_for_assignment',
            'assignment',
            'normal',
            'core'
        );
 
    }

    /**
     * Funktionen som läser in den specifika fil som ligger i metaboxen. Filen innehåller HTML och PHP som 
     * skriver ut en select-box med "custom post type"-kurs
     *
     */

    function meta_box_for_assignment($post) {
        
        require_once get_template_directory().'/partials/cpt-assignment-meta-box.php';
    
    }

    add_action('add_meta_boxes', 'add_meta_box_to_assignment');

    /**
     * Extra sparfunktion till custom post type "assignment" som sparar kopplad kurs. Körs i samband med att man sparar en post.
     *
     */

    function special_save_cpt_assignment($post_id, $post, $update) {

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times

        //if ( !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) ) {    return; }

        // If not correct slug

        if('assignment' != $post->post_type) {
            return;
        }

        // Save metadata

        if ( isset( $_POST['cpt_courses_assignments'] ) ) {

            delete_post_meta($post_id, 'cpt_courses_assignments');
            
            foreach($_POST['cpt_courses_assignments'] as $assignment) {

                add_post_meta( 
                    $post_id, 
                    'cpt_courses_assignments', 
                    sanitize_text_field( $assignment ) 
                );

            }

        }

    }

    add_action('save_post', 'special_save_cpt_assignment', 10, 3);
?>