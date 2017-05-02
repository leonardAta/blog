<?php
	ob_start();
	session_start();

	$page_title = "Add Category";

	#load db connection
	include 'includes/db.php';	

	#include functions
	include 'includes/functions.php';


	#include header
	include 'includes/dashboard_header.php';


	$errors = [];
	
	if(array_key_exists('add', $_POST)) {
		if(empty($_POST['category_name'])) {
			$errors['category_name'] = "Enter Blog Category Name";
		}
		if(empty($errors)) {
			#eliminate unwanted spaces
			$clean = array_map('trim', $_POST);

			addCategory($conn, $clean);

		}
	}

?>



<div class="wrapper">
	<div id="stream">


		<h1 id="register-label">Add Category</h1>

		<form id="register" method="post" action="addcategory.php">

			<div>

				<label>Category Name: </label>

				<?php displayErrors($errors, 'category_name'); ?>
				<input type="text" name="category_name" placeholder="Category Name">
				<br/>

			</div>

			<input type="submit" name="add" value="add">

		</form>

	</div>
</div>

<?php 

	include "includes/footer.php";

?>
	
