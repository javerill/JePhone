<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_SESSION['UserLogin']) || $_SESSION['UserLogin']['Role']!="admin" || !isset($_POST['hfProductID']))
	{
		header('location:../index.php');
		return;
	}
	include ("connect.php");

	$ProductID = trim($_POST['hfProductID']);
	$Photo = $_POST['hfPhoto'];

	if (file_exists("../".$Photo)) {
	    unlink("../".$Photo);
	}

	
	$query="DELETE FROM msProduct WHERE ProductID=$ProductID";
	$result = mysql_query($query);

	header('location:../product.php?'.'message=Delete Product Success');
	
?>