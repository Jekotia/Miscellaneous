<?php
	if (isset($_GET['p'])) {$p = $_GET['p'];}
	else {$p = '1';}

	$count = 100;
	$num = $count * $p + $count;

	echo "<strong>Page #".$p."</strong> - ";

	if ( $p > 1 )
	{
		$pp = $p-1;
		echo "<a href='?p=".$pp."' >Previous Page</a>  -  ";
	}
	$pn = $p+1;
	echo "<a href='?p=".$pn."' >Next Page</a><br/>".PHP_EOL."<br/>".PHP_EOL;

	include_once('../auth.php');
	$mysql_db = 'minecraft';

	mysql_connect($mysql_host, $mysql_user, $mysql_pass)or die("cannot connect");
	mysql_select_db($mysql_db)or die("cannot select DB");

	$result = mysql_query("SELECT * FROM `lb-players` LIMIT ".$num.",".$count);
	while($row = mysql_fetch_array($result))
	{
		$IP1 = substr($row['ip'], 0, strpos($row['ip'], ":"));
		$IP1 = trim($IP1, "/");
		$playername = $row['playername'];

		$counter = 0;
		$result2 = mysql_query("SELECT * FROM `lb-players` WHERE `ip` LIKE '%".$IP1."%' AND NOT `playername` = 'Console' AND NOT `playername` = 'LavaFlow' AND NOT `playername` = 'WaterFlow' AND NOT `playername` = 'BlockDriller' AND NOT `playername` = '".$playername."'");

		while($row2 = mysql_fetch_array($result2))
		{
			$IP2 = substr($row2['ip'], 0, strpos($row2['ip'], ":"));
			$IP2 = trim($IP2, "/");

			if ( $IP1 == $IP2 && $counter == 0 ) {
				echo $IP1." - ".$row['playername']." - ".$row2['playername'];
				$counter = 1;
			}
			elseif ( $IP1 == $IP2 ) {
				echo " - ".$row2['playername'];
			}
		}
		if ( $counter == 1 ) {echo "<br/>".PHP_EOL;}
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