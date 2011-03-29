<?php
//Debug mode. Only use for testing/development purposes. Not recomended that be used if the script is publically accessable, it reveals information that could potentially compromise the phpBB3 installations security. It may be safe, too. Not sure. All I know is with 'debug mode' off this script is harmless (unless modified).
	$debug			=		false;

//Set this to your MySQL host address. Some servers are configured oddly and there CAN be a difference between localhost and 127.0.0.1.
	$mysql_host		=		'localhost';
//The username you want to connect to MySQL with
	$mysql_user		=		'root';
//The MySQL password for the above user
	$mysql_pass		=		'derp';
//The MySQL database used by minecraft
	$mysql_db		=		'tsg_phpbb3';
//The prefix of the phpbb3 tables in the database. This is 'phpbb_' by default.
	$prefix			=		'phpbb_';

//Chat Name database field name. This will be the Field Identification (from when you configured the new profile field in phpBB3) prefixed with 'pf_'
	$db_chat_name	=		'pf_chat_name';
//3DS Friend Code database field name. This will be the Field Identification (from when you configured the new profile field in phpBB3) prefixed with 'pf_'
	$db_tds_fc		=		'pf_tds_friend_code';

//This point onward, DO NOT EDIT UNLESS YOU KNOW WHAT YOU ARE DOING, there is no room for error 
//Establish MySQL connection
	$con = mysql_connect($mysql_host,$mysql_user,$mysql_pass);
	if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($mysql_db, $con);
?>
<html>
	<head>
		<title>3DS Friend Code Listing</title>
	</head>
	<body>
		<table border='1' cellspacing='0' cellpadding='0'>
			<tr>
				<th>Forum Name</th>
				<th>Chat Name</th>
				<th>3DS Friend Code</th>
			</tr>
		<?php
			if($debug==true){$loop_count = 1;}
			$result = mysql_query("SELECT * FROM ".$prefix."users");
			while($row = mysql_fetch_array($result))
			{
				$user_id = $row['user_id'];
				$forum_name = $row['username'];
				$user_type = $row['user_type'];
		
				if($debug==true){echo '<br />$user_id='.$user_id;}
				if($debug==true){echo ',$forum_name='.$forum_name;}
				if($debug==true){echo ',$user_type='.$user_type;}
		
				$result2 = mysql_query("SELECT * FROM ".$prefix."profile_fields_data WHERE user_id = ".$user_id."");
				while($row2 = mysql_fetch_array($result2))
				{
					$chat_name = $row2[$db_chat_name];
										$tds_fc = $row2[$db_tds_fc];
				}
				if ($user_type === '2')
				{
					if($debug==true){echo " - SKIPPING";}
				}
				else//if (isset($forum_name) AND isset($chat_name) AND isset($tds_fc))
				{
					echo "
			<tr>
				<td>".$forum_name."</td>";
					if ($chat_name === '')
					{
						echo '<td align="center">-</td>';
					}
					else
					{
						echo '<td>'.$chat_name.'</td>';
					}
					if ($tds_fc === '')
					{
						echo '<td align="center">-</td>';
					}
					else
					{
						echo '<td>'.$tds_fc.'</td>';
					}
					echo "
			</tr>";
				}
				unset($forum_name);
				unset($chat_name);
				unset($tds_fc);
				
				if($debug==true){echo '<br />Loops='.$loop_count;}
				if($debug==true){$loop_count++;}
			}
		?>

		</table>
	</body>
</html>