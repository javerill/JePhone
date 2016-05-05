<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	include ("connect.php");

	if(!isset($_SESSION['UserLogin']) || !isset($_POST['hfMemberID']))
	{
		header('location:../index.php');
		return;
	}else if($_SESSION['UserLogin']['Role']!="admin")
	{
		header('location:../index.php');
		return;	
	}

	$MemberID = trim($_POST['hfMemberID']);
	$Status = trim($_POST['hfStatus']);
	$Page = isset($_GET['page'])?$_GET['page']:'1';

	if($Status=="ban")
	{
		$query="UPDATE msmember SET Status='banned' WHERE MemberID=$MemberID";
		$result = mysql_query($query);

		header('location:../member_list.php?'.'message=Ban User Success'.'&page='.$Page);
	}else
	{
		$query="UPDATE msmember SET Status='none' WHERE MemberID=$MemberID";
		$result = mysql_query($query);

		header('location:../member_list.php?'.'message=Unban Member Success'.'&page='.$Page);
	}

	
?>