<?php

	unset($_SESSION['admin_id']);
	unset($_SESSION['email']);

	header('Location:login.php');


?>