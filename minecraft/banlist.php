<html><body>
<?php

// change these things

	include_once('../auth.php');
	$dbname = "minecraft";
   
mysql_connect($server, $dbuser, $dbpass);
mysql_select_db($dbname);

$result = mysql_query("SELECT * FROM banlist ORDER BY time DESC");

echo "<table width=70% border=1 cellpadding=5 cellspacing=0>";

echo "<tr style=\"font-weight:bold\">
<td>Name</td>
<td>Reason</td>
<td>Admin/Mod</td>
<td>Time of ban</td>
<td>Time of unban</td>
</tr>";

$col = "#eeeeee";

while($row = mysql_fetch_assoc($result)){
if($col == "#eeeeee"){
$col = "#ffffff";
}else{
$col = "#eeeeee";
}
echo "<tr bgcolor=$col>";

echo "<td>".$row['name']."</td>";
echo "<td>".$row['reason']."</td>";
echo "<td>".$row['admin']."</td>";
echo "<td>".$row['time']."</td>";
if($row['temptime'] == "0000-00-00 00:00:00"){
echo "<td>Permanent</td>";
}else{
echo "<td>".$row['temptime']."</td>";
}

echo "</tr>";
}

echo"</table>"

?>
Ban database provided by <a href="http://forums.bukkit.org/threads/admn-kiwiadmin-v2-0-kick-temp-ban-unban-mysql-and-flatfile-670.1681/">KiwiAdmin</a>.
</body></html>
