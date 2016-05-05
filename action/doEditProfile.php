<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_POST['txtFullname']))
	{
		header('location:../index.php');
		return;
	}
	include ("connect.php");

	$Username = $_SESSION['UserLogin']['Username'];
	$Fullname= trim($_POST['txtFullname']);
	$Gender= $_POST['gender'];
	$Email= trim($_POST['txtEmail']);
	$Phone= trim($_POST['txtPhone']);
	$Address=trim($_POST['txtAddress']);
	$Photo= $_FILES['filePhoto']['name'];
	$TypePhoto = $_FILES['filePhoto']['type'];
	$DeletePhoto = isset($_POST['cbxDeletePhoto'])?$_POST['cbxDeletePhoto']:"";


	//validasi semua field harus diisi kecuali profile picture
	if($Fullname=="" || $Gender=="" || $Email=="" || $Phone=="" || $Address=="" )
	{
		header('location:../member_detail.php?'.'message=All field must be field, except Profile Picture.'.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.$Address);
		return;	
	}


	//validasi email address harus valid
	if (!filter_var($Email, FILTER_VALIDATE_EMAIL))
	{ 
		header('location:../member_detail.php?'.'message=Email must be a valid email, ex:erwinkodok@gmail.com.'.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.$Address);
		return;	
	}

	//validasi phone number
	if (!is_numeric($Phone)) 
	{
		header('location:../member_detail.php?'.'message=Phone number must be numeric only.'.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.$Address);
		return;	
	}

	//validasi address harus mengandung 'Street'
	if (strstr($Address,'Street')=='') 
	{
		header('location:../member_detail.php?'.'message=Address must contains \'Street\' (Case Sensitive).'.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.$Address);
		return;	
	}

	if($DeletePhoto=="Yes")
	{
		if($_SESSION['UserLogin']['Image']!="UserImage/Default.jpg")
		{
			if (file_exists("../".$_SESSION['UserLogin']['Image'])) {
			    unlink("../".$_SESSION['UserLogin']['Image']);
			}
		}
		$UserPhoto="UserImage/Default.jpg";
	}
	else
	{
		if($Photo!="")
		{
			if($TypePhoto != 'image/gif' && $TypePhoto != 'image/png' && $TypePhoto != 'image/jpeg' && $TypePhoto != 'image/jpg')
			{
			    header('location:../member_detail.php?'.'message=Profile Picture must be image (jpeg, jpg, png, gif).'.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.$Address);
				return;	
			}

			if($_SESSION['UserLogin']['Image']!="UserImage/Default.jpg")
			{
				if (file_exists("../".$_SESSION['UserLogin']['Image'])) {
				    unlink("../".$_SESSION['UserLogin']['Image']);
				}
			}

			$UserPhoto="UserImage/".$Username.(date("YmdHis")).".".pathinfo($_FILES["filePhoto"]["name"], PATHINFO_EXTENSION);
			move_uploaded_file($_FILES["filePhoto"]["tmp_name"],"../".$UserPhoto);
		}else
		{
			$UserPhoto=$_SESSION['UserLogin']['Image'];
		}
	}

	$query="UPDATE msmember set Fullname = '".$Fullname."',Gender = '".$Gender."',Email ='".$Email."' ,Phone ='".$Phone."' , Address ='".$Address."' , Image = '".$UserPhoto."' WHERE Username = '".$Username."'";
	$result = mysql_query($query);

	$_SESSION['UserLogin']['Fullname']=$Fullname;
	$_SESSION['UserLogin']['Gender']=$Gender;
	$_SESSION['UserLogin']['Email']=$Email;
	$_SESSION['UserLogin']['Phone']=$Phone;
	$_SESSION['UserLogin']['Address']=$Address;
	$_SESSION['UserLogin']['Image']=$UserPhoto;
		

	header('location:../member_detail.php?'.'message=1');	
?>