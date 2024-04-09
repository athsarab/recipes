<?php

$dbserver = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbdatabase = "ex1";

class mysqlb {
	
	function verify_un_and_pwd($un, $pwd) {
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;
		$conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
	    $query = "select * 
		          from user_profile 
		          where username = ? and password = ?
		          limit 1";
				  
		if($stmt = $conn->prepare($query)) {
			$stmt->bind_param('ss', $un, $pwd);
			$stmt->execute();
			
			if($stmt->fetch()) {
			   $stmt->close();
			   $conn->close();
			   return true;
			}
		}
	}
}

?>