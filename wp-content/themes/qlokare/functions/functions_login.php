<?php 
/**
 * WordPress function for redirecting users on login based on user role
 */
function my_login_redirect( $url, $request, $user ){
    if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
        if( $user->has_cap( 'admin' ) ) {
            $url = admin_url();
        } else {
            $url = home_url('/index.php/');
        }
    }
    return $url;
}
add_filter('login_redirect', 'my_login_redirect', 10, 3 );