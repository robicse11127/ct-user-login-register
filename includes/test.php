<?php 
// a simple WordPress frontend login implementation
// written by Arūnas Liuiza | tinyStudio | wp.tribuna.lt
// Usage: use [tiny_login] shortcode or get_tiny_login_form()/the_tiny_login_form() template tags
// Arguments: one (optional) argument 'redirect': pass url where to redirect after successful login (default: false);

// Localization: replace 'theme' with your text domain string.

// login action hook - catches form submission and acts accordingly
add_action('init','tiny_login');
function tiny_login() {
  global $tiny_error;
  $tiny_error = false;
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $creds = array();
    $creds['user_login'] = $_POST['username'];
    $creds['user_password'] = $_POST['password'];
    //$creds['remember'] = false;
    $user = wp_signon( $creds );
    if ( is_wp_error($user) ) {
      $tiny_error = $user->get_error_message();
    } else {
      if (isset($_POST['redirect']) && $_POST['redirect']) {
        wp_redirect($_POST['redirect']);
      }
    }
  }
}

// shows error message
function the_tiny_error() {
  echo get_tiny_error();
}

function get_tiny_error() {
  global $tiny_error;
  if ($tiny_error) {
    $return = $tiny_error;
    $tiny_error = false;
    return $return;
  } else {
    return false;
  }
}

// shows login form (or a message, if user already logged in)
function get_tiny_login_form($redirect=false) {
  if (!is_user_logged_in()) {
    $return = "<form action=\"\" method=\"post\" class=\"tiny_form tiny_login\">\r\n";
    $error = get_tiny_error();
    if ($error)
      $return .= "<p class=\"error\">{$error}</p>\r\n";
    $return .= "  <p>
      <label for=\"tiny_username\">".__('Username','theme')."</label>
      <input type=\"text\" id=\"tiny_username\" name=\"username\" value=\"".(isset($_POST['username'])?$_POST['username']:"")."\"/>
    </p>\r\n";
    $return .= "  <p>
      <label for=\"tiny_password\">".__('Password','theme')."</label>
      <input type=\"password\" id=\"tiny_password\" name=\"password\"/>
    </p>\r\n";
    if ($redirect)
      $return .= "  <input type=\"hidden\" name=\"redirect\" value=\"{$redirect}\">\r\n";
    $return .= "  <button type=\"submit\">".__('Login Now','theme')."</button>\r\n";
    $return .= "</form>\r\n";
  } else {
    $return = "<p>".__('User is already logged in','theme')."</p>";
  }
  return $return;
}

function the_tiny_login_form($redirect=false) {
  echo get_tiny_login_form($redirect);
}

// adds a handy [tiny_login] shortcode to use in posts/pages
add_shortcode('ct_user_rl_login','tiny_login_shortcode');
function tiny_login_shortcode ($atts,$content=false) {
  $atts = shortcode_atts(array(
    'redirect' => false
  ), $atts);
  return get_tiny_login_form($atts['redirect']);
}
?>