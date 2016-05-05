<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	

	if(!isset($_POST['txtUsername']))
	{
		header('location:../index.php');
		return;
	}
	
	include ("connect.php");
	
	$Username = trim($_POST['txtUsername']);
	$Password= $_POST['txtPassword'];
	$Remember = isset($_POST['cbxRemember'])?$_POST['cbxRemember']:"";

	//validasi semua field harus diisi
	if($Username=="" || $Password=="")
	{
		header('location:../login.php?'.'message=All field must be field.');
		return;	
	}

		//validation username harus yang belum terdaftar
	$query="SELECT * FROM msmember where Username = '".$Username."' and Password='".md5($Password)."'";
	$result  = mysql_query($query);

	$num_rows = mysql_num_rows($result);
	
	if($num_rows>=1)
	{
		$row = mysql_fetch_assoc($result);

		if($row['Status']=="banned")
		{
			header('location:../login.php?'.'message=Your account has been banned.');
			return;
		}

		if(!isset($_SESSION['UserLogin']))
		{
			$_SESSION['UserLogin'] = array();	
		}

		$_SESSION['UserLogin']['Username']=$row['Username'];
		$_SESSION['UserLogin']['MemberID']=$row['MemberID'];
		$_SESSION['UserLogin']['Fullname']=$row['Fullname'];
		$_SESSION['UserLogin']['Gender']=$row['Gender'];
		$_SESSION['UserLogin']['Email']=$row['Email'];
		$_SESSION['UserLogin']['Phone']=$row['Phone'];
		$_SESSION['UserLogin']['Address']=$row['Address'];
		$_SESSION['UserLogin']['Image']=$row['Image'];
		$_SESSION['UserLogin']['Role']=$row['Role'];
		$_SESSION['UserLogin']['Status']=$row['Status'];

		if($Remember=="Yes")
		{
			setcookie('Username', $Username, time() + 60 * 60, "/");
			setcookie('Password', $Password, time() + 60 * 60, "/");
		}else
		{
			setcookie('Username', $Username, time() - 100, "/");	
			setcookie('Password', $Password, time() - 100, "/");
		}

		header('location:../index.php');
	}
	else
	{
		header('location:../login.php?'.'message=Wrong Username or Password combination.');
		return;
	}

?>