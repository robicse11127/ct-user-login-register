<?php
class Ct_User_Rl_Helper {

	public function __construct() {
		add_action( 'login_head', array( $this, 'ct_user_rl_custom_login' ) );
		add_filter( 'login_url', array( $this, 'ct_user_rl_login_link_url' ), 10, 2 );
		add_filter( 'wp_nav_menu_items', array( $this, 'ct_user_rl_add_login_logout_link' ), 10, 2 );
	}

	// Login redirects
	public function ct_user_rl_custom_login() {
		$url = home_url( '/' ).get_option('ct-user-rl-login-slug');
		echo '<script>window.location.href="'.esc_url( $url ).'"</script>';
	}
	 
	public function ct_user_rl_login_link_url( $url ) {
	   $url = home_url( '/' ).esc_attr( get_option('ct-user-rl-login-slug') );
	   return $url;
	}

	// Login Logout Links
	public function ct_user_rl_add_login_logout_link($items, $args) {
	    ob_start();
	    wp_loginout('index.php');
	    $loginoutlink = ob_get_contents();
	    ob_end_clean();
	    $items .= '<li>'. $loginoutlink .'</li>';
	    return $items;
	}

}
new Ct_User_Rl_Helper;