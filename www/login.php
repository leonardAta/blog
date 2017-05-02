<?php

	ob_start();
	session_start();

	#page title
	$page_title = "Admin Log in";

	#include header
	include 'includes/header.php';

	#include database
	include 'includes/db.php';

	#include functions
	include 'includes/functions.php';

	#track errors
	$errors = [];

	if(array_key_exists('register', $_POST)) {

		if(empty($_POST['email'])) {
			$errors['email'] = "please enter email";
		}

		if(empty($_POST['password'])) {
			$errors['password'] = "please enter password";
		}

		if(empty($errors)) {
			#do database stuff
			#eliminate unwanted spaces from values in the $_POST array
			$clean = array_map('trim', $_POST);

			#$chk = 
			adminLogin($conn, $clean);


		}
	}



?>


	<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register" action ="login.php" method ="POST">

			<div>
				
				<?php displayErrors($errors, 'email'); ?>				
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				
				<?php displayErrors($errors, 'password'); ?>				
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="register" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
	</div>

<?php

	#include footer
	include 'includes/footer.php';

?>