<?php 
class Ct_User_Rl_Settings {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'ct_user_rl_admin_page' ) );
		add_action( 'admin_init', array( $this, 'ct_user_rl_setting_options' ) );
	}

	public function ct_user_rl_admin_page() {
		add_submenu_page( "options-general.php", "User Register/Login", "User Register/Login", "manage_options", "ct-user-rl", array($this, 'ct_user_rl_menu_page') ); 
	}

	public function ct_user_rl_menu_page() {
	?>
		<div class="wrap">
			<h2>CT User Register/Login Settings</h2>
			<form action="options.php" method="post">
				<?php 
					settings_fields( 'ct_user_rl_settings_section' );
					do_settings_sections( 'ct-user-rl' );
					submit_button();
				?>
			</form>
		</div>
	<?php
	}

	public function ct_user_rl_setting_options() {
		add_settings_section( 'ct_user_rl_settings_section', '', null, 'ct-user-rl' );

		add_settings_field( 'ct-user-rl-login-slug', 'Login Page Slug', array( $this, 'ct_user_login_slug' ), 'ct-user-rl', 'ct_user_rl_settings_section' );
		add_settings_field( 'ct-user-rl-register-slug', 'Register Page Slug', array( $this, 'ct_user_register_slug' ), 'ct-user-rl', 'ct_user_rl_settings_section' );

		register_setting( 'ct_user_rl_settings_section', 'ct-user-rl-login-slug' );
		register_setting( 'ct_user_rl_settings_section', 'ct-user-rl-register-slug' );
	}

	/**
	* Settings Fields
	*/
	public function ct_user_login_slug() {
		?>
		<input type="text" name="ct-user-rl-login-slug" value="<?php echo esc_attr(get_option('ct-user-rl-login-slug')); ?>">
		<?php
	}

	public function ct_user_register_slug() {
		?>
		<input type="text" name="ct-user-rl-register-slug" value="<?php echo esc_attr(get_option('ct-user-rl-register-slug')); ?>">
		<?php
	}

}
new Ct_User_Rl_Settings;
