<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_POST['hfCommentID']))
	{
		header('location:../index.php');
		return;
	}
	include ("connect.php");

	$MemberID = $_SESSION['UserLogin']['MemberID'];
	$Content= trim($_POST['txtContent']);
	$ProductID = $_POST['hfProductID'];
	$CommentID = $_POST['hfCommentID'];

	//validasi content tidak boleh kosong
	if($Content == "") {
		header('location:../comment_detail.php?'.'messageReview=Review must be filled.'.'&ProductID='.$ProductID.'&content='.$Content.'&ReviewID='.$CommentID.'#'.$CommentID);
    	return;
	}

	//validasi content not contain html tag
	if($Content != strip_tags($Content)) {
		header('location:../comment_detail.php?'.'messageReview=Review must not contain any html tag.'.'&ProductID='.$ProductID.'&content='.$Content.'&ReviewID='.$CommentID.'#'.$CommentID);
    	return;
	}

	if(strlen($Content) > 200) {
		header('location:../comment_detail.php?'.'messageReview=Review length maximal 200 character.'.'&ProductID='.$ProductID.'&content='.$Content.'&ReviewID='.$CommentID.'#'.$CommentID);
    	return;
	}

	$query="UPDATE trComment SET Content='".$Content."' WHERE MemberID = ".$MemberID." AND CommentID=".$CommentID;
	$result = mysql_query($query);

	
	header('location:../product_detail.php?'.'messageReview=3'.'&ProductID='.$ProductID.'#review');
	
?>