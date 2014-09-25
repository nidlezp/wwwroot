<?php 
        /*** start the session ***/
        session_start();

        /*** include the header file ***/
        include 'includes/header.php';
		
        /*** set a form token ***/
		$form_token = md5(rand(time(), true));

		/*** set the session form token ***/
		$_SESSION['form_token'] = $form_token;
		
?>

<h1>Blog Login</h1>
<p>
Please supply your username and password.
</p>
<form action="login_submit.php" method="post">
<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
<dl>
<dt>Username</dt>
<dd><input type="text" name="blog_user_name" /></dd>

<dt>Password</dt>
<dd><input type="password" name="blog_user_password" /></dd>
<dd><input type="submit" value="Login" /></dd>
</dl>
</form>

<?php include 'includes/footer.php'; ?>