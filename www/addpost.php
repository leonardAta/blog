<?php
	ob_start();
	session_start();

	#add page title
	$page_title = "Add Post";

	# load db connection
	include 'includes/db.php';	

	# include functions
	include 'includes/functions.php';

	#include header
	include 'includes/dashboard_header.php';

	#track errors
	$errors = [];

	#max file size
	define("MAX_FILE_SIZE", "2097152");

	#permitted image extensions
	$ext = ["image/jpeg", "image/jpg", "image/png"];

	if(array_key_exists('add', $_POST)) {


		if(empty($_POST['Title'])) {
			$errors['Title'] = "Enter Title";
		}
		if(empty($_POST['Content'])) {
			$errors['Content'] = "Enter Content";
		}
	

		if(empty($_POST['Date'])) {
			$errors['Date'] = "Enter Date";
		}
	
		if(empty($_FILES['pic']['name'])) {
			$errors['pic'] = "Please select a file";
		}
		
		if($_FILES['pic']['size'] > MAX_FILE_SIZE) {
				$errors['pic'] = "File size exceeds maximum. max size: 2mb";
		}

		#check file format
		if(!in_array($_FILES['pic']['type'], $ext)) {
			$errors['pic'] = "File type not supported";
		}

		#upload files
		$check = doUpload($_FILES, 'pic', 'uploads/');

		if($check[0]) {
			$destination = $check[1];
		} else {
				$errors['pic'] = "File upload failed";
		}


		if(empty($errors)) {
			//do database stuff
			#eliminate unwanted spaces
			$clean = array_map('trim', $_POST);
			$clean['Content'] = htmlspecialchars($clean['Content']);
			$clean['admin_id'] = $_SESSION['admin_id'];
			$stmt = $conn->prepare("INSERT INTO Post(admin_id, title, content, date_added, filepath) VALUES(:aid, :t, :c, :d, :f)");
	
			$data = [
					':aid' => $clean['admin_id'],
					':t' => $clean['Title'],
					':c' => $clean['Content'],
					':d' => $clean['Date'],
					':f' => $destination


			];

			$stmt->execute($data);

		}
	}

?>



	<h1 id="register-label">Add Post</h1>
	<hr/>


	<form id="register" method="post" action="addpost.php" enctype="multipart/form-data">
	
	<div>			
		<?php displayErrors($errors, 'Title'); ?>
		<label>Title:</label>
		<input type="text" name="Title" placeholder="Title"/><br/>
	</div>
	
	<div>
		<?php displayErrors($errors, 'Content'); ?>	
		<label>Content:</label>
		<textarea rows="4" cols="20" type="textfield" name="Content" placeholder="Content"></textarea><br/>

<!--
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>


  <textarea rows="4" cols="5" type="textfield" name="Content" placeholder="Content"></textarea><br/> -->





	</div>

	<div>
		<?php displayErrors($errors, 'Date'); ?>
		<label>Date:</label>
		<input type="date" name="Date" placeholder="Date"/><br/>
	</div>


	<div>
		<?php displayErrors($errors, 'pic'); ?>
		<label>Image:</label>
		<input type="file" name="pic"/><br/>
	</div>


		<input type="submit" name="add" value="add"/>

	</form>
	<hr/>



<?php
	include 'includes/footer.php'; 
?>
