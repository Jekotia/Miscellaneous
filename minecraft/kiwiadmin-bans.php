<?php
	function append_file($filename,$newdata)
	{
		$f=fopen($filename,"a");
		fwrite($f,$newdata);
		fclose($f);
	}

	function read_file($filename)
	{
		$f=fopen($filename,"r");
		$data=fread($f,filesize($filename));
		fclose($f);
		return $data;
	}
   
	$ka_bantable	=   'banlist';
	$mysql_host		=	'localhost';
	$mysql_user		=	'root';
	$mysql_pass		=	'november';
	$mysql_db		=	'minecraft';
	$write_location	=	'banned_names.txt';
	
	$con = mysql_connect($mysql_host,$mysql_user,$mysql_pass);
	if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($mysql_db, $con);
	
	$result = mysql_query("SELECT name FROM banlist");
	while($row = mysql_fetch_array($result))
	{
		//add more data ot the existing file
		append_file($write_location,$row['name'].'
');
	}
	echo 'Bans written!';
?>