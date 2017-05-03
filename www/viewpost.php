<?php
	ob_start();
	session_start();

	

	$page_title = "View Post";

	#load db connection
	include 'includes/db.php';	
	
	#include functions
	include 'includes/functions.php';

	#include header
	include 'includes/dashboard_header.php';
?>


	<div class="wrapper">
		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>Post ID</th>
						<th>Title</th>
						<th>Content</th>
						<th>Date Added</th>
						<th>Edit</th>
						<th>Delete</th>
						
					</tr>

					

				</thead>
				<tbody>
				<?php

						$viewPost = viewPost($conn);
						echo $viewPost;

				?>
          		</tbody>

			</table>
		</div>
	</div>

<?php

	#include footer
	include 'includes/footer.php';
?>