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
	$Password = $_POST['txtPassword'];
	$ConfirmPassword = $_POST['txtConfirmPassword'];
	$Fullname = trim($_POST['txtFullname']);
	$Gender = $_POST['gender'];
	$Email = trim($_POST['txtEmail']);
	$Phone = trim($_POST['txtPhone']);
	$Address = trim($_POST['txtAddress']);
	$Photo = $_FILES['filePhoto']['name'];
	$TypePhoto = $_FILES['filePhoto']['type'];
	$Confirmation = isset($_POST['cbxConfirmation'])?$_POST['cbxConfirmation']:"";

	//checkbox validation
	if($Confirmation!="Yes")
	{
		header('location:../register.php?'.'message=Agreement must be confirmed.'.'&username='.$Username.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address));
		return;	
	}

	//all fields validation
	if($Username=="")
	{
		header('location:../register.php?'.'message=All fields must be filled, except Profile Picture.'.'&username='.$Username.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address));
		return;	
	}


	//validation username harus yang belum terdaftar
	$query="SELECT * FROM msmember where Username = '".$Username."'";
	$result  = mysql_query($query);

	$num_rows = mysql_num_rows($result);
	
	if($num_rows>=1)
	{
		header('location:../register.php?'.'message=Username has been used.'.'&username='.$Username.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address));
		return;
	}

	//validasi semua field harus diisi kecuali profile picture
	if($Password=="" || $ConfirmPassword=="" || $Fullname=="" || $Gender=="" || $Email=="" || $Phone=="" || $Address=="" )
	{
		header('location:../register.php?'.'message=All fields must be filled, except Profile Picture.'.'&username='.$Username.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address));
		return;	
	}

	//validasi username tidak boleh lebih dari 1 kata
	for($a=0;$a<strlen($Username);$a++)
	{
		if($Username{$a}==" ")
		{
			header('location:../register.php?'.'message=Username must not contain space.'.'&username='.$Username.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address));
			return;	
		}
	}

	//validasi password dan confirm password harus sama
	if($Password!=$ConfirmPassword)
	{
		header('location:../register.php?'.'message=Password and Confirm Password should be same.'.'&username='.$Username.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address));
		return;	
	}

	//validasi email address harus valid
	if (!filter_var($Email, FILTER_VALIDATE_EMAIL))
	{ 
		header('location:../register.php?'.'message=Email must be a valid email, ex:erwinkodok@gmail.com.'.'&username='.$Username.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address));
		return;	
	}

	//validasi phone number
	if (!is_numeric($Phone)) 
	{
		header('location:../register.php?'.'message=Phone number must be numeric only.'.'&username='.$Username.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address));
		return;	
	}

	//validasi address harus mengandung 'Street'
	if (strstr($Address,'Street')=='') 
	{
		header('location:../register.php?'.'message=Address must contains \'Street\' (Case Sensitive).'.'&username='.$Username.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address));
		return;	
	}

	if($Photo!="")
	{
		if($TypePhoto != 'image/gif' && $TypePhoto != 'image/png' && $TypePhoto != 'image/jpeg' && $TypePhoto != 'image/jpg')
		{
		    header('location:../register.php?'.'message=Profile Picture must be file image (jpeg, jpg, png, gif).'.'&username='.$Username.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address));
			return;	
		}
		$UserPhoto="UserImage/".$Username.(date("YmdHis")).".".pathinfo($_FILES["filePhoto"]["name"], PATHINFO_EXTENSION);
		move_uploaded_file($_FILES["filePhoto"]["tmp_name"],"../".$UserPhoto);
	}else
	{
		$UserPhoto="UserImage/Default.jpg";
	}

	$query="INSERT INTO msmember (Username,Password,Fullname,Gender,Email,Phone,Address,Image) 
	values('".$Username."','".md5($Password)."','".$Fullname."','".$Gender."','".$Email."','".$Phone."','".$Address."','".$UserPhoto."')";
	$result = mysql_query($query);

	header('location:../register.php?'.'message=1');
?>