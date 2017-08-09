# ct-user-login-register
A WordPress plugin for front-end user registration and login.

<h4>How to install?</h4>
Download the zip file and extract it in the <code>wp-content >> plugins</code> directory.

<h4>How to use it?</h4>
<p>After installing the plugins activate it. Then create 3 pages, e.g: <strong>Register</strong>, <strong>Login</strong>, <strong>Success</strong></p>

<p>In <b>Register</b> page use the shortcode: <code>[ ct_user_rl_register redirect="success" ]</code>. The shortocde has 1 parameter <b>(redirect)</b>. Put the redirect page <b>slug name</b> in the redirect parameter within the quotation mark.</p>

<p>In <b>Success</b> page use the shortcode: <code>[ ct_user_rl_success ]</code>. The shortcode has 1 parameter <b>(success_msg)</b>. It has a default value. So, if you want to change the message then use the parameter.</p>

<p>Finally, in <b>Login</b> page use the shortcode: <code>[ ct_user_rl_login ]</code>. It has no additional parameters.</p>

<h4>Plugin Settings Page</h4>
<p>Under the admin menu's <b><code>Settings</code></b>, you will find a menu named <code>User Register/Login</code>. Go there and add the <b>Login</b> and <b>Register</b> page's slug name and save it.</p>
<p><b>For example: </b> If you create a page named <b>Login</b> then use the page slug name <code>login</code> and save it.</p>

<p>That's it. Enjoy!!!</p>
