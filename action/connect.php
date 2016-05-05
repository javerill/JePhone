<?php
	$conn = mysql_connect('ap-cdbr-azure-east-c.cloudapp.net','b512dde9ca32c8','484813a3') or die (mysql_error());
	mysql_select_db('jephone',$conn) or die("Cannot connect to database");
?>
