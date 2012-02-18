<?php
	include 'auth.php'
	$rnd = rand(1, 9000);
	
	$con = mysql_connect($mysql_host,$mysql_user,$mysql_pass);
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($mysql_db, $con);
	
	$result = mysql_query("SELECT * FROM jokes WHERE id = '.$rnd.'");
	while($row = mysql_fetch_array($result))
	{
		echo $row['joke'];
	}
?>