<?php 
/**
 * WordPress function for redirecting users on login based on user role
 */

//require_once plugin_dir_path( __FILE__ ) . 'functions/functions-custom-register.php';
	require_once plugin_dir_path( __FILE__ ) . 'functions-custom-post-types.php';

	
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