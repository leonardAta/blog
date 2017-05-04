<?php

	function adminRegister($dbconn, $input) {
		$stmt = $dbconn->prepare("INSERT INTO Admin(firstname, lastname, email, hash) VALUES(:fn, :ln, :e, :h)");

		#bind parameters
		$data = [
			":fn" =>$input['fname'],
			":ln" =>$input['lname'],
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

	function redirect($loc, $msg) {
		header("Location: ".$loc.$msg);
	}


	function adminLogin($dbconn, $input) {
		$result = [];

		$stmt = $dbconn->prepare("SELECT * FROM Admin WHERE email=:e");
		$stmt->bindParam(":e", $input["email"]);

		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_BOTH);

		$count = $stmt->rowCount();

		if(($count != 1) || !password_verify($input['password'], $row['hash'])) {
			redirect("login.php?msg", "username/password incorrect");
			
			exit();

		} else {
			$result[] = true;
          	$result[] = $row['admin_id'];
          	//redirect("viewpost.php", "");
        }

        return $result;
		
	}

/*	function addPost($dbconn, $add)  {
		$stmt = $dbconn->prepare("INSERT INTO Post(title, content) VALUES(:t, :c)");
		$data = [
			":t" =>$add['title'],
			":c" =>$add['content']

		];
		$stmt->execute($data);

	} */

	function addCategory($dbconn, $add) {
		$stmt = $dbconn->prepare("INSERT INTO Category(category_name) VALUES(:c)");
		$stmt->bindParam(":c", $add['category_name']);

		$stmt->execute();
	}

	function viewCategory($view) {
		$result = "";
		while($return = $view->fetch(PDO::FETCH_ASSOC)) {
			$catID = $return['category_id'];
			$catName = $return['category_name'];

			$result .= '<tr><td>'.$return['category_id'].'</td>';
			$result .= '<td>'.$return['category_name'].'</td>';
			$result .= '<td><a href="editCategory.php?category_id='.$return['category_id'].'">edit</a></td>';
			$result .= '<td><a href="deleteCategory.php?category_id='.$return['category_id'].'">delete</a></td></tr>';
		}
		return $result;
	}

	function viewPost($dbconn) {
		$result = "";

		$stmt = $dbconn->prepare("SELECT * FROM Post");
		$stmt->execute();
		while($row = $stmt->fetch(PDO::FETCH_BOTH)) {
			$post_id = $row['post_id'];
			$title = $row['title'];
			$content = $row['content'];
			$date_added = $row['date_added'];

			$result = '<tr><td>'.$row['post_id'].'</td>';
			$result .='<td>'.$row['title'].'</td>';
			$result .='<td>'.$row['content'].'<td>';
			$result .= '<td><a href="editpost.php?post_id='.$row['post_id'].'">edit</a></td>';
			$result .= '<td><a href="deletepost.php?post_id='.$row['post_id'].'">delete</a></td></tr>';
		}
		return $result;
	}


	function doUpload($files, $names, $uploadir) {
		$data = [];
		$rnd = rand(0000000000, 9999999999);

	$strip_name = str_replace(" ", "_", $files[$names]['name']);
	$filename = $rnd.$strip_name;
	$destination = $uploadir.$filename;

	if(!move_uploaded_file($files[$names]['tmp_name'], $destination)) {
		$data[] = false;
	} else {
		$data[] = true;
		$data[] = $destination;
	}
		return $data;
	}

	function fetchCategory($dbconn, $catName) {
		$result = "";

		$stmt = $dbconn->prepare("SELECT * FROM Category");
		$stmt->execute();

		while($row=$stmt->fetch(PDO::FETCH_BOTH)) {
			$cat_id = $row['category_id'];
			$cat_name = $row['category_name'];

			if($cat_name == $catName) {
				continue;
			}
			$result .= "<option value='$cat_id'>$cat_name</option>";

		}
	return $result;	


	}

	function getPostByID($dbconn, $pid) {
		$stmt = $dbconn->prepare("SELECT * FROM Post WHERE post_id=:bid");
		$stmt->bindParam(":bid", $pid);

		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_BOTH);

		return $row;


	}

	function getCategoryByID($dbconn, $cat_id) {

		$stmt = $dbconn->prepare("SELECT * FROM Category WHERE category_id=:cid");
		$stmt->bindParam(":cid", $cat_id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_BOTH);

		return $row;

	}

	function deletePost($dbconn, $pstid) {
		$stmt = $dbconn->prepare("DELETE FROM Post WHERE post_id=:pid");
		$stmt->bindParam(":pid", $pstid);

		$stmt->execute();
	}

	function getAdminByID($dbconn, $aid) {
		$stmt = $dbconn->prepare("SELECT * FROM Admin WHERE admin_id=:aid");
		$stmt->bindParam(":aid", $aid);

		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_BOTH);

		return $row;
	}

	function fetchPost($dbconn, $cb) {
		$stmt = $dbconn->prepare("SELECT post_id, admin_id, title, content, DATE_FORMAT(date_added, '%M %d %Y') AS dd FROM Post");
		
		$stmt->execute();
		$cb($dbconn, $stmt);

	}

	function getArchive($dbconn, $cb) {
		$stmt = $dbconn->prepare("SELECT DISTINCT DATE_FORMAT(date_added, '%M, %Y') AS my FROM Post");

		$stmt->execute();
		$cb($dbconn, $stmt);

	}





?>