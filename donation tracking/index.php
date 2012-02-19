<link type="text/css" href="css/base/jquery-ui.css" rel="Stylesheet" />	
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
<script>
$(function() {
	$( "#accordion" ).accordion();
});
</script>

<?php
	$minerp_bill_due = "March 14th";
	$minerp_bill_sum = 50;
	$id = array("1"=>"	","2"=>"		","3"=>"			","4"=>"				");
// database connect
	include_once('../auth.php');
	$mysql_db = 'repo_misc';
	$mysql_table_prefix = 'dt_';
	mysql_connect($mysql_host, $mysql_user, $mysql_pass)or die("cannot connect");
	mysql_select_db($mysql_db)or die("cannot select DB");

//########
// Update
//########
	if (isset($_GET['action']))
	{
		$action = $_GET['action'];
		if ($action = 'update')
		{
		// update user expenses
			$minerp_exp_total = 0;
			$query_select_users = mysql_query("SELECT * FROM `dt_users`");
			while($row_select_users = mysql_fetch_array($query_select_users))
			{
				$user_exp_num = 0;
				$user_exp_total = 0;
		
				$query_select_expenses = mysql_query("SELECT * FROM `dt_expenses` WHERE `exp_user_id` = '".$row_select_users['user_id']."'");
				while($row_select_expenses = mysql_fetch_array($query_select_expenses))
				{
					$user_exp_num++;
					$user_exp_total = $user_exp_total + $row_select_expenses['exp_amount'];
					$minerp_exp_total = $minerp_exp_total + $row_select_expenses['exp_amount'];
				}
				$query_update_users = "UPDATE `".$mysql_table_prefix."users` SET `user_exp_num` = '".$user_exp_num."', `user_exp_total` = '".$user_exp_total."' WHERE `user_id` = '".$row_select_users['user_id']."'";
				mysql_query($query_update_users);
				
				$query_update_minerp = "UPDATE `".$mysql_table_prefix."users` SET `user_exp_total` = '".$minerp_exp_total."' WHERE `user_id` = '1'";
				mysql_query($query_update_minerp);
			}
		// update user income
			$minerp_inc_total = 0;
			$query_select_users = mysql_query("SELECT * FROM `dt_users` LIMIT 10,1000");
			while($row_select_users = mysql_fetch_array($query_select_users))
			{
				$user_inc_num = 0;
				$user_inc_total = 0;
		
				$query_select_income = mysql_query("SELECT * FROM `dt_income` WHERE `inc_user_id` = '".$row_select_users['user_id']."'");
				while($row_select_income = mysql_fetch_array($query_select_income))
				{
					$user_inc_num++;
					$user_inc_total = $user_inc_total + $row_select_income['inc_amount'];
					$minerp_inc_total = $minerp_inc_total + $row_select_income['inc_amount'];
				}
				$query_update_users = "UPDATE `".$mysql_table_prefix."users` SET `user_inc_num` = '".$user_inc_num."', `user_inc_total` = '".$user_inc_total."' WHERE `user_id` = '".$row_select_users['user_id']."'";
				mysql_query($query_update_users);
				
				$query_update_minerp = "UPDATE `".$mysql_table_prefix."users` SET `user_inc_total` = '".$minerp_inc_total."' WHERE `user_id` = '1'";
				mysql_query($query_update_minerp);
			}
			echo "Data updated. Click <a href='index.php'>here</a> to go back.";
			die;
		}
	}
?>
<div class="demo">
	<div id="accordion">
<?php
	$query_select_minerp = mysql_query("SELECT * FROM `dt_users` WHERE `user_id` = '1'");
	$row_select_minerp = mysql_fetch_array($query_select_minerp);
	$minerp_avail_funds = $row_select_minerp['user_inc_total'] - $row_select_minerp['user_exp_total'];
	echo $id[2]."<h3><a href='#'>Server Finances</a></h3>".PHP_EOL;
	echo $id[2]."<div>".PHP_EOL;
	echo $id[3]."Total donations: $".$row_select_minerp['user_inc_total']." <br/>".PHP_EOL;
	echo $id[3]."Total expenses: $".$row_select_minerp['user_exp_total']." <br/>".PHP_EOL;
	echo $id[3]."Available funds: $".$minerp_avail_funds." <br/>".PHP_EOL;
	echo $id[3]."Required funds: $".$minerp_bill_sum." <br/>".PHP_EOL;
	echo $id[3]."Bill due ".$minerp_bill_due.PHP_EOL;
	echo $id[2]."</div>".PHP_EOL;

	$query_select_users = mysql_query("SELECT * FROM `dt_users` LIMIT 10,1000");
	while($row_select_users = mysql_fetch_array($query_select_users))
	{
		$user_inc_num = 0;
		echo $id[2]."<h3><a href='#'>".$row_select_users['user_label']." - ".$row_select_users['user_inc_num']." donation(s) - $".$row_select_users['user_inc_total']." total</a></h3>".PHP_EOL;
		echo $id[2]."<div>".PHP_EOL;

		$query_select_income = mysql_query("SELECT * FROM `dt_income` WHERE `inc_user_id` = '".$row_select_users['user_id']."'");
		while($row_select_income = mysql_fetch_array($query_select_income))
		{
			$user_inc_num++;
			if ($user_inc_num > 1) echo $id[3]."<br/>".PHP_EOL;
			echo $id[3]."$".$row_select_income['inc_amount']." - ".$row_select_income['inc_timestamp'].PHP_EOL;
		}
		echo $id[2]."</div>".PHP_EOL;
	}
?>
		</div>
	</div>
</div>
<br/>
<br/>
<a href='?action=update'>Update</a>