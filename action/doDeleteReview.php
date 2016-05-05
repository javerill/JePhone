<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_SESSION['UserLogin']) || !isset($_POST['hfCommentID']))
	{
		header('location:../index.php');
		return;
	}

	include ("connect.php");
	
	$CommentID = $_POST['hfCommentID'];
	$ProductID = $_POST['hfProductID'];

	$query="DELETE FROM trComment WHERE CommentID = ".$CommentID." AND MemberID=".$_SESSION['UserLogin']['MemberID'];
	$result = mysql_query($query);

	header('location:../product_detail.php?'.'messageReview=2'.'&ProductID='.$ProductID.'#review');
	
?>