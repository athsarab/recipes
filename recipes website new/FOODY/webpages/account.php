<?php
    require "dbinfo.php"
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Register Output</title>
    </head>
    <body>
<?php
	$username = $_POST["username"];
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$mobile = $_POST["mobile"];
	$dob = $_POST["dob"];
	$password = $_POST["password"];
	$confirmpassword = $_POST["confirmpassword"];
	$usererr = "";
	$usererrlen = "";
	$pwerr = "";
	$pwerrlen = "";
	$dberr = "";
	$firsterrlen = "";
	$lasterrlen = "";

	if($username == "")
	{
		$usererrlen = "Username cannot be empty";
	}
  if(strlen($username) <= 5 or strlen($username) >= 20)
  {
    $usererrlen = ("Username must be between 5 and 20 characters." . strlen($username));
  }

	if($firstname == "")
	{
		$firsterrlen = "First name cannot be empty";
	}

	if($lastname == "")
	{
		$lasterrlen = "Last name cannot be empty";
	}

	if($password != $confirmpassword)
	{
		$pwerr = "Passwords do not match";
	}

	if(strlen($password) < 6)
	{
		$pwerrlen = "Password should be at least 6 characters";
	}

	$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
  if ($connection->connect_error)
  {
      // Unable to make a connection.  Display the error message returned
      $dberr = "Unable to establish a connection to the database $connection->connect_error";
  }

	else
	{
<<<<<<< Updated upstream
		$stmt = $connection->prepare("select username from User_Profile where User_Profile.username = ?");
		$stmt->bind_param("s",$username);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result -> fetch_assoc();
        if (!empty($row))
		{
			$usererr = "Username Already exists";
		}
		$stmt->close();
=======
    $query = "select username from User_Profile where User_Profile.username = ?";
        $statement = $connection->prepare($query);
    $statement->bind_param('s', $username);
    $statement->execute();
        $statement->store_result();
        $statement->bind_result($usercheck);
    if (is_null($usercheck))
    {
    	$usererr = "";
    }
    else
    {
    	$usererr = "Username Already exists";
    }
    $statement->close();
>>>>>>> Stashed changes
        $connection->close();
	}

	function redisplay($usererr,$pwerr,$pwerrlen,$dberr,$usererrlen,$firsterrlen,$lasterrlen)
	{
		if($usererr != "" )
		{
			echo "<p>$usererr</p>";
		}
		if($pwerr != "" )
		{
			echo "<p>$pwerr</p>";
		}
		if($pwerrlen != "" )
		{
			echo "<p>$pwerrlen</p>";
		}
		if($dberr != "" )
		{
			echo "<p>$dberr</p>";
		}
		if($usererrlen != "" )
		{
			echo "<p>$usererrlen</p>";
		}
		if($firsterrlen != "" )
		{
			echo "<p>$firsterrlen</p>";
		}
		if($lasterrlen != "" )
		{
			echo "<p>$lasterrlen</p>";
		}
		?>
		<form method='POST' action='account.php'>
		<table>
		  <tr>
			<td>Username:</td>
			<td><input type="text" name="username"></td>
		  </tr>
		  <tr>
			<td>First Name:</td>
			<td><input type="text" name="firstname"></td>
		  </tr>
		  <tr>
			<td>Last Name:</td>
			<td><input type="text" name="lastname"></td>
		  </tr>
		  <tr>
			<td>Mobile Number:</td>
			<td><input type="text" name="mobile"></td>
		  </tr>
		  <tr>
			<td>Date Of Birth:</td>
			<td><input type="date" name="dob"></td>
		  </tr>
		  <tr>
			<td>Password:</td>
			<td><input type="password" name="password"></td>
		  </tr>
		  <tr>
			<td>Confirm password:</td>
			<td>
			<input type="password" name="confirmpassword"></td>
		  </tr>
		 </table>
		  <p><input type="submit" VALUE="Submit Registration Information"></p>
		<?php
	}
	if($usererr != "" || $pwerr != "" || $pwerrlen != "" || $dberr != "" || $usererrlen != "" || $firsterrlen != "" || $lasterrlen != "")
	{
		redisplay($usererr,$pwerr,$pwerrlen,$dberr,$usererrlen,$firsterrlen,$lasterrlen);
	}
	else
	{
		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if ($connection->connect_error)
		{
			// Unable to make a connection.  Display the error message returned
			$dberr = "Unable to establish a connection to the database $connection->connect_error";
		}
		else
		{
			$query = "INSERT INTO User_Profile (username, Forename, Surname, password, dob, mobile) VALUES (?, ?, ?, ?, ?, ?)";
			$statement = $connection->prepare($query);
			$statement->bind_param('ssssss', $username, $firstname, $lastname, $password, $dob, $mobile);
			$statement->execute();
			$statement->close();
			$connection->close();
			echo("<p>User added.</p>");
		}
	}
?>
</body>
</html>
