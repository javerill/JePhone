<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	include ("connect.php");

	if(!isset($_POST['hfProductID']))
	{
		header('location:../index.php');
		return;
	}

	$MemberID = $_SESSION['UserLogin']['MemberID'];
	$Content= trim($_POST['txtContent']);
	$ProductID = $_POST['hfProductID'];

	//validasi content tidak boleh kosong
	if($Content == "") {
		header('location:../product_detail.php?'.'messageReview=Review must be filled.'.'&ProductID='.$ProductID.'&content='.$Content.'#review');
    	return;
	}

	//validasi content not contain html tag
	if($Content != strip_tags($Content)) {
		header('location:../product_detail.php?'.'messageReview=Review must not contain any html tag.'.'&ProductID='.$ProductID.'&content='.$Content.'#review');
    	return;
	}

	if(strlen($Content) > 200) {
		header('location:../product_detail.php?'.'messageReview=Review length maximal 200 character.'.'&ProductID='.$ProductID.'&content='.$Content.'#review');
    	return;
	}

	$query="INSERT INTO trComment (ProductID,MemberID,Content,CommentDate) values('".$ProductID."','".$MemberID."','".$Content."',NOW())";
	$result = mysql_query($query);

	header('location:../product_detail.php?'.'messageReview=1'.'&ProductID='.$ProductID.'#review');
	
?>