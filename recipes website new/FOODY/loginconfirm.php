<?php

require 'mysqlb.php';

class loginconfirm {
	function validate_user($un, $pwd) {
		$mysql = new mysqlb();
		$ensure_cred = $mysql->verify_un_and_pwd($un, $pwd);

		if($ensure_cred) {
			$_SESSION['status'] = 'authorised';
			header("location: homepage.php");
		} else return "<br><br><br>please enter valid username and password";
	}
}

?>
