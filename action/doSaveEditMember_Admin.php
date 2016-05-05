<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_POST['hfMemberID']))
	{
		header('location:../index.php');
		return;
	}

	include ("connect.php");

	$MemberID = $_POST['hfMemberID'];
	$Fullname= trim($_POST['txtFullname']);
	$Gender= $_POST['gender'];
	$Email= trim($_POST['txtEmail']);
	$Phone= trim($_POST['txtPhone']);
	$Address=trim($_POST['txtAddress']);
	$Photo= $_FILES['filePhoto']['name'];
	$TypePhoto = $_FILES['filePhoto']['type'];
	$DeletePhoto = isset($_POST['cbxDeletePhoto'])?$_POST['cbxDeletePhoto']:"";
	$Role = $_POST['ddlRole'];
	$Status = $_POST['ddlStatus'];

	//validasi semua field harus diisi kecuali profile picture
	if($Fullname=="" || $Gender=="" || $Email=="" || $Phone=="" || $Address=="" )
	{
		header('location:../edit_member_admin.php?'.'message=All fields must be filled, except Profile Picture.'.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address).'&role='.$Role.'&status='.$Status.'&MemberID='.$MemberID);
		return;	
	}


	//validasi email address harus valid
	if (!filter_var($Email, FILTER_VALIDATE_EMAIL))
	{ 
		header('location:../edit_member_admin.php?'.'message=Email must be a valid email, ex:erwinkodok@gmail.com.'.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address).'&role='.$Role.'&status='.$Status.'&MemberID='.$MemberID);
		return;	
	}

	//validasi phone number
	if (!is_numeric($Phone)) 
	{
		header('location:../edit_member_admin.php?'.'message=Phone number must be numeric only.'.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address).'&role='.$Role.'&status='.$Status.'&MemberID='.$MemberID);
		return;	
	}

	//validasi address harus mengandung 'Street'
	if (strstr($Address,'Street')=='') 
	{
		header('location:../edit_member_admin.php?'.'message=Address must contains \'Street\' (Case Sensitive).'.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address).'&role='.$Role.'&status='.$Status.'&MemberID='.$MemberID);
		return;	
	}

	if($DeletePhoto=="Yes")
	{
		if($_POST['hfPhoto']!="UserImage/Default.jpg")
		{
			if (file_exists("../".$_POST['hfPhoto'])) {
			    unlink("../".$_POST['hfPhoto']);
			}
		}
		$NewPhoto="UserImage/Default.jpg";
	}
	else
	{
		if($Photo!="")
		{
			if($TypePhoto != 'image/gif' && $TypePhoto != 'image/png' && $TypePhoto != 'image/jpeg' && $TypePhoto != 'image/jpg')
			{
			    header('location:../edit_member_admin.php?'.'message=Profile Picture must be file image (jpeg, jpg, png, gif).'.'&fullname='.$Fullname.'&gender='.$Gender.'&email='.$Email.'&phone='.$Phone.'&address='.urlencode($Address).'&role='.$Role.'&status='.$Status.'&MemberID='.$MemberID);
				return;	
			}

			if($_POST['hfPhoto']!="UserImage/Default.jpg")
			{
				if (file_exists("../".$_POST['hfPhoto'])) {
				    unlink("../".$_POST['hfPhoto']);
				}
			}

			$NewPhoto="UserImage/".$Username.(date("YmdHis")).".".pathinfo($_FILES["filePhoto"]["name"], PATHINFO_EXTENSION);
			move_uploaded_file($_FILES["filePhoto"]["tmp_name"],"../".$NewPhoto);
		}else
		{
			$NewPhoto=$_POST['hfPhoto'];
		}
	}

	$query="UPDATE msmember set Fullname = '".$Fullname."',Gender = '".$Gender."',Email ='".$Email."' ,Phone ='".$Phone."' , Address ='".urlencode($Address)."' , Image = '".$NewPhoto."',Status = '".$Status."',Role = '".$Role."' WHERE MemberID = ".$MemberID;
	$result = mysql_query($query);

	header('location:../edit_member_admin.php?'.'message=1'.'&MemberID='.$MemberID);	
?>