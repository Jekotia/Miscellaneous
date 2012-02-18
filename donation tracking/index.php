<link type="text/css" href="css/base/jquery-ui.css" rel="Stylesheet" />	
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>

<?php
$id = array("1"=>"	","2"=>"		","3"=>"			","4"=>"				");
// database connect
	include_once('../auth.php');
	$mysql_db	=	'repo_misc';
	mysql_connect($mysql_host, $mysql_user, $mysql_pass)or die("cannot connect");
	mysql_select_db($mysql_db)or die("cannot select DB");
// database queries
	$query_user_label = mysql_query("SELECT * FROM `dt_users`");
	$query_income = mysql_query("SELECT * FROM `dt_income` ORDER BY `inc_id` DESC");
// array prep
	$array_user_label = array("0"=>"null");
// stores 'user_id => user_label' pairs in $array_user_label
	while($row_user_label = mysql_fetch_array($query_user_label))
	{
		array_push($array_user_label, $row_user_label['user_label']);

		//while (list($key,$value) = each($array_user_label))
		//{
		//	echo $key." : ".$value." <br/>".PHP_EOL;
		//}
	}

//
?>
<table>
	<tr>
		<th>Name</th>
		<th>Amount</th>
		<th>Label</th>
		<th>Timestamp</th>
	</tr>
<?php
	while($row_income = mysql_fetch_array($query_income))
	{
		echo $id[1]."<tr>".PHP_EOL;
		//echo $id[2]."<td>".$row_income['inc_id']."</td>".PHP_EOL;
		echo $id[2]."<td>".$array_user_label[$row_income['inc_user_id']]."</td>".PHP_EOL;
		echo $id[2]."<td>".$row_income['inc_amount']."</td>".PHP_EOL;
		echo $id[2]."<td>".$row_income['inc_label']."</td>".PHP_EOL;
		echo $id[2]."<td>".$row_income['inc_datetime']."</td>".PHP_EOL;
		echo $id[1]."</tr>".PHP_EOL;
	}
	echo "</table>".PHP_EOL;
?>

<script>
$(function() {
	$( "#accordion" ).accordion({
		collapsible: true
	});
});
</script>
<div class="demo">
	<div id="accordion">
		<h3><a href="#">Section 1</a></h3>
		<div>
			<p>Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.</p>
		</div>
		<h3><a href="#">Section 2</a></h3>
		<div>
			<p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna. </p>
		</div>
		<h3><a href="#">Section 3</a></h3>
		<div>
			<p>Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui. </p>
			<ul>
				<li>List item one</li>
				<li>List item two</li>
				<li>List item three</li>
			</ul>
		</div>
		<h3><a href="#">Section 4</a></h3>
		<div>
			<p>Cras dictum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia mauris vel est. </p><p>Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
		</div>
	</div>
</div>