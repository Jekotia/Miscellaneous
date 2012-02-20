<?php
	$username = $_POST['username'];
	$password = $_POST['password'];
	//connect to the database here
	$username = mysql_real_escape_string($username);
	$query = "SELECT password, salt
			FROM users
			WHERE username = '$username';";
	$result = mysql_query($query);
	if(mysql_num_rows($result) < 1) //no such user exists
	{
		header('Location: login_form.php');
	}
	$userData = mysql_fetch_array($result, MYSQL_ASSOC);
	$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );
	if($hash != $userData['password']) //incorrect password
	{
		header('Location: login_form.php');
	}
	//login successful
?>

<form name="login" action="login.php" method="post">
    Username: <input type="text" name="username" />
    Password: <input type="password" name="password" />
    <input type="submit" value="Login" />
</form>