<?php 
 # test.php sandbox
#ob_start();
#session_start();

#database credentials
define('DBHOST', 'localhost');
define('DBNAME', 'iBlog');
define('DBUSER', 'root');
define('DBPASS', 'THINKandflyy');




try {
	#prepare a PDO instance
	$conn = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME, DBUSER, DBPASS);

	#set verbose error modes
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

} catch(PDOException $e) {
	echo $e->getMessage();
}





?>