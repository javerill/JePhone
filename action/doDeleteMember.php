<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_SESSION['UserLogin']) || $_SESSION['UserLogin']['Role']!="admin" || !isset($_POST['hfMemberID']))
	{
		header('location:../index.php');
		return;
	}
	
	include ("connect.php");
	$MemberID = trim($_POST['hfMemberID']);
	$Photo = $_POST['hfPhoto'];
	$Page = isset($_GET['page'])?$_GET['page']:'1';

	if($Photo!="UserImage/Default.jpg")
	{
		if (file_exists("../".$Photo)) {
		    unlink("../".$Photo);
		}
	}

	
	$query="DELETE FROM msmember WHERE MemberID=$MemberID";
	$result = mysql_query($query);
	
	header('location:../member_list.php?'.'message=Delete Member Success'.'&page='.$Page);
	
?>