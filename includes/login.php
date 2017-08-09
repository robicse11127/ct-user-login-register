<?php 
class Ct_User_Login {

	private $username;
	private $password;
	private $error = false;

	public function __construct() {
		add_shortcode( 'ct_user_rl_login', array( $this, 'ct_user_rl_login_form_shortcode' ) );
		add_action( 'init', array( $this, 'ct_user_rl_login_process' ) );
	}

	public function ct_user_rl_login_form_shortcode() {
		ob_start();
		$this->reg_url = $reg_url;
		$this->ct_user_rl_login_form($redirect);
		$this->ct_user_rl_form_validation();
		return ob_get_clean();
	}

	public function ct_user_rl_login_process() {
		if( isset( $_POST['ct_username'] )  && $_POST['ct_password'] ) {
			$login_data = array();
			$login_data['user_login'] = $_POST['ct_username'];
			$login_data['user_password'] = $_POST['ct_password'];
			$user = wp_signon( $login_data );
			if( is_wp_error( $user ) ) {
				$this->error = $user->get_error_message();
			}else {
				$url = home_url( '/' ).'dashboard';
				echo '<script>window.location.href="'.esc_url($url).'"</script>';
			}
		}
	}

	public function ct_user_rl_form_validation() {
		if($_POST['submit'] ){
			$this->username = esc_attr($_POST['ct_username']);
			$this->password = esc_attr($_POST['ct_password']);

			if( empty( $this->username ) || empty( $this->password ) ) {
				return new WP_Error( 'field', 'You need to fillup both username and password.' );
			}
			if( empty( $this->username ) ) {
				return new WP_Error( 'username', 'Please provide your username!' );
			}
			if( empty( $this->passowrd ) ) {
				return new WP_Error( 'password', 'Please provide your passowrd!' );
			}
		}
	}

	public function ct_user_rl_login_form() {
		if( !is_user_logged_in() ) {
			?>
			<div class="ct-user-login-form">
				<form action="" method="POST">
			        <p>
			            <label form="username">Username<span class="asteric">*</span> :</label>
			            <input type="text" name="ct_username" value="<?php echo( isset( $_POST['ct_username'] ) ? $_POST['ct_username'] : null );  ?>" required="required" />
			        </p>
			        <p>
			            <label form="password">Password<span class="asteric">*</span> :</label>
			            <input type="password" name="ct_password" required="required" />
			        </p>
			        <p>
			            <input type="submit" name="submit" value="Login" >
			        </p>
			    </form>
			    <?php  
			    	if( !empty( $this->error ) ) {
			    		echo '<div class="error-msg">'.$this->error.'</div>';
			    	}else {
			    		if( is_wp_error( $this->ct_user_rl_form_validation() ) ) {
				    		echo '<div class="error-msg">
				    		<p>'.$this->ct_user_rl_form_validation()->get_error_message().'</p>
				    		</div>';
				    	}
			    	}
			    ?>
			    <p>Do not have any account? <strong><a href="<?php echo esc_url( home_url( '/' ).esc_attr( get_option('ct-user-rl-register-slug') ) ); ?>">Please Register</a></strong></p>
			</div>
			<?php
		}else {
			echo esc_html__( 'You are already loggedin!', 'ct-user-rl' );
		}
	}
}
new Ct_User_Login;