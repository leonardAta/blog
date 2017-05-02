<?php

	ob_start();
	session_start();

	# load db connection
	include 'includes/db.php';

	#page title
	$page_title = "View Category";

	# include functions
	include 'includes/functions.php';

	#include header
	include 'includes/dashboard_header.php';
	
?>



	<div class="wrapper">
		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>Category ID</th>
						<th>Category Name</th>
						<th>Edit</th>
						<th>Delete</th>
						
					</tr>

	
				</thead>
				<tbody>
					<?php

						$stmt = $conn->prepare("SELECT * FROM Category");
						$stmt->execute();
						$viewCat = viewCategory($stmt);
						echo $viewCat;


					?> 
          		</tbody>
			</table>
		</div>

		<div class="paginated">
			<a href="category.php">Add Category</a>
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">2</a>
		</div>
	</div>
<?php
	#include footer
	include 'includes/footer.php';
?>
