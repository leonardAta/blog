<?php
	ob_start();
	session_start();

	#add page title
	$page_title = "Edit Post";

	# load db connection
	include 'includes/db.php';	

	# include functions
	include 'includes/functions.php';

	#include header
	include 'includes/dashboard_header.php';

	#track errors
	$errors = [];

	#query string incoming request
	if(isset($_GET['post_id'])) {
		$postID = $_GET['post_id'];
	}

	#get a post object
	$item = getPostByID($conn, $postID);

	#get item category
	#$category = getCategoryByID($conn, $item['category_id']);;


?>



	<h1 id="register-label">Edit Post</h1>
	<hr/>


	<form id="register" method="post" action="editpost.php" enctype="multipart/form-data">
	
	<div>			
		<?php displayErrors($errors, 'Title'); ?>
		<label>Title:</label>
		<input type="text" name="Title" placeholder="Title" value="<?php echo $item['title'];?>"/><br/>
	</div>
	
	<div>
		<?php displayErrors($errors, 'Content'); ?>	
		<label>Content:</label>
		<textarea rows="4" cols="20" type="textfield" name="Content" placeholder="Content" value="<?php echo $item['content'];?>"></textarea><br/>
	</div>

	<div>
		<?php displayErrors($errors, 'Date'); ?>
		<label>Date:</label>
		<input type="date" name="Date" placeholder="Date" value="<?php echo $item['date_added'];?>"/><br/>
	</div>

	<div>
				<label>Select Category:</label>
				<select>
					<option></option>

					<?php 
					
					$choose = fetchCategory($conn, $cat_name['category_name']);

					echo $choose;

					?>

				</select>
			</div>


		<input type="submit" name="" value="add"/>

	</form>

	</div>

		<h4 class="jumpto">Upload a new image? <a href="editimage.php">image</a></h4>
	</div>
	<hr/>



<?php
	include 'includes/footer.php'; 
?>
