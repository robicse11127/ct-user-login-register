<?php 
/**
* Plugin Name: User Registration & Login
* Description: User registration and login system from frontend panel.
* Author: Md Rabiul Islam Patwary
* Author URI: http://example.com
* Text Domain: ct-user-rl
*/
if( !defined( 'ABSPATH' ) ) exit; // No direct access allowed.

define( 'CT_USER_RL_URL', plugins_url( '/', __FILE__ ) );
define( 'CT_USER_RL_PATH', plugin_dir_path( __FILE__ ) );

require_once CT_USER_RL_PATH.'includes/register.php';
require_once CT_USER_RL_PATH.'includes/success.php';
require_once CT_USER_RL_PATH.'includes/login.php';
require_once CT_USER_RL_PATH.'includes/helper.php';
require_once CT_USER_RL_PATH.'admin/settings.php';

function ct_user_rl_register_scripts() {
	wp_enqueue_style( 'ct-user-rl-style', CT_USER_RL_URL.'assets/css/ct-user-rl-style.css' );
	wp_enqueue_script( 'ct-user-rl-script', CT_USER_RL_URL.'assets/js/ct-user-rl-script.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'ct_user_rl_register_scripts' );


