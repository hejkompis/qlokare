<?php

	/**
     * Metabox för att koppla lärare till kurs.
     *
     * Funktion som skapar en metabox i custom post type "Course" där vi ges möjlighet att lägga till
     * kursansvarig lärare.
     * Hör ihop med funktionerna "meta_box_for_courses" och "special_save_cpt_course"
     */

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
