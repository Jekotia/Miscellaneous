<?php
	if (isset($_GET['p'])) {$p = $_GET['p'];}
	else {$p = '1';}

	$count = 25;
	$num = $count * $p + $count;

	echo "<strong>Page #".$p."</strong> - ";

	if ( $p > 1 )
	{
		$pp = $p-1;
		echo "<a href='?p=".$pp."' >Previous Page</a>  -  ";
	}
	$pn = $p+1;
	echo "<a href='?p=".$pn."' >Next Page</a> - Showing ".$count." entries per page.<br/>".PHP_EOL."<br/>".PHP_EOL;

	include_once('../auth.php');
	$mysql_db = 'minecraft';
	mysql_connect($mysql_host, $mysql_user, $mysql_pass)or die("cannot connect");
	mysql_select_db($mysql_db)or die("cannot select DB");
	
	$result = mysql_query("SELECT * FROM `lb-new-kills` ORDER BY `date` DESC LIMIT ".$num.",".$count);
	//$result = mysql_query("SELECT * FROM `lb-new-kills`") or die("SELECT * FROM lb-new-kills"."<br/><br/>".mysql_error());
	while($row = mysql_fetch_array($result))
	{
		//Match the victim ID to the victim name and store the value
		$result2 = mysql_query("SELECT `playername` FROM `lb-players` WHERE `playerid` = '".$row['victim']."'");
		while($row2 = mysql_fetch_array($result2))
		{
			$victim = $row2['playername'];
		}

		//Match the killer ID to the killer name and store the value
		$result2 = mysql_query("SELECT `playername` FROM `lb-players` WHERE `playerid` = '".$row['killer']."'");
		while($row2 = mysql_fetch_array($result2))
		{
			$killer = $row2['playername'];
		}

		//Echo what happened.
		echo "On ".$row['date']." ".$killer." killed ".$victim." with a ".$row['weapon'] . PHP_EOL. "<br/>" .PHP_EOL;
	}
	echo "<br/>" .PHP_EOL;
	if ( $p > 1 )
	{
		$pp = $p-1;
		echo "<a href='?p=".$pp."' >Previous Page</a>  -  ";
	}
	$pn = $p+1;
	echo "<a href='?p=".$pn."' >Next Page</a>";
?>