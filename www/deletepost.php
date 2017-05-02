<?php 

	ob_start();
	session_start();

	$page_title = "Delete Post";

	#include functions
	include 'includes/functions.php';

	# load db connection
	include 'includes/db.php';	


	#include header
	include 'includes/dashboard_header.php';

	
	#get request with id
	if(isset($_GET['post_id'])) {
		$postID = $_GET['post_id'];
	}

	#call delete function
	deletePost($conn, $postID);

	#redirect 
	redirect('viewpost.php', "");
	

?>


