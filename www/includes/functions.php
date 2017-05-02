<?php

	function adminRegister($dbconn, $input) {
		$stmt = $dbconn->prepare("INSERT INTO Admin(firstname, lastname, email, hash)VALUES(:fn, :ln, :e, :h)");

		#bind parameters
		$data = [
			":fn" =>$input['firstname'],
			":ln" =>$input['lastname'],
			":e" =>$input['email'],
			"h" =>$input['password']


		];
		$stmt->execute($data);

	}


	function displayErrors($array, $key) {
		if(isset($array[$key])) {
			echo '<span class="err">'.$array[$key].'</span>';
			return true;
		}
	}

	function adminLogin($dbconn, $input) {
		$stmt = $dbconn->prepare("SELECT * FROM Admin WHERE email=:e");
		$stmt->bindParam(":e", $input["email"]);
		$stmt->execute();

			$count = $stmt->rowCount();
		

		if($count == 1) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if(password_verify($enter['password'], $row['hash'])) {
				$_SESSION['id'] = $row['Admin'];
				$_SESSION['email'] = $row['email'];

				header('Location:addpost.php');
			}
			else {
				$error_login = "incorrect email and/or password";
				header("Location:login.php?error_login=$error_login");
			}
		} 

	}


?>