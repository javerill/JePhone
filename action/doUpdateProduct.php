<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_POST['hfProductID']))
	{
		header('location:../index.php');
		return;
	}
	include ("connect.php");

	$ProductID = $_POST['hfProductID'];
	$OldPhoto = $_POST['hfOldPhoto'];
	$ProductName = trim($_POST['txtProductName']);
	$Category = $_POST['ddlCategory'];
	$Stock= trim($_POST['txtStock']);
	$Price= trim($_POST['txtPrice']);
	$Description= trim($_POST['txtDescription']);
	$Photo= $_FILES['filePhoto']['name'];
	$TypePhoto = $_FILES['filePhoto']['type'];

	//validasi semua field harus diisi kecuali description
	if($ProductName=="" || $Category=="" || $Stock=="" || $Price=="")
	{
		header('location:../product_update.php?'.'message=All field must be filled, except Description.'.'&productname='.$ProductName.'&category='.$Category.'&stock='.$Stock.'&price='.$Price.'&description='.urlencode($Description).'&ProductID='.$ProductID);
		return;	
	}

	//validasi photo
	if($Photo!="")
	{
		if($TypePhoto != 'image/png' && $TypePhoto != 'image/jpeg' && $TypePhoto != 'image/jpg')
		{
		    header('location:../product_update.php?'.'message=Product Image must be file image (jpeg, jpg, png).'.'&productname='.$ProductName.'&category='.$Category.'&stock='.$Stock.'&price='.$Price.'&description='.urlencode($Description).'&ProductID='.$ProductID);
			return;	
		}
	}

	//validasi Stock harus numeric
	if (!is_numeric($Stock)) 
	{
		header('location:../product_update.php?'.'message=Stock must be numeric only.'.'&productname='.$ProductName.'&category='.$Category.'&stock='.$Stock.'&price='.$Price.'&description='.urlencode($Description).'&ProductID='.$ProductID);
		return;	
	}else
	{
		//validasi Stock harus lebih besar dari 0 (Must more than zero)
		if((int)$Stock<=0)
		{
			header('location:../product_update.php?'.'message=Stock must greater than zero.'.'&productname='.$ProductName.'&category='.$Category.'&stock='.$Stock.'&price='.$Price.'&description='.urlencode($Description).'&ProductID='.$ProductID);
		return;	
		}
	}

	//validasi Price harus numeric
	if (!is_numeric($Price)) 
	{
		header('location:../product_update.php?'.'message=Price must be numeric only.'.'&productname='.$ProductName.'&category='.$Category.'&stock='.$Stock.'&price='.$Price.'&description='.urlencode($Description).'&ProductID='.$ProductID);
		return;	
	}else
	{
		//validasi Stock harus lebih besar = 0 (Must more than or equal zero)
		if((int)$Price<0)
		{
			header('location:../product_update.php?'.'message=Price must greater than or equal zero.'.'&productname='.$ProductName.'&category='.$Category.'&stock='.$Stock.'&price='.$Price.'&description='.urlencode($Description).'&ProductID='.$ProductID);
		return;	
		}
	}


	if($Photo!="")
	{
		if (file_exists("../".$OldPhoto)) {
		    unlink("../".$OldPhoto);
		}

		$NewPhoto="ProductImage/".$ProductName.(date("YmdHis")).".".pathinfo($_FILES["filePhoto"]["name"], PATHINFO_EXTENSION);
		move_uploaded_file($_FILES["filePhoto"]["tmp_name"],"../".$NewPhoto);
	}else
	{
		$NewPhoto=$OldPhoto;
	}

	$query="UPDATE msproduct SET CategoryID='".$Category."' ,Name='".$ProductName."' ,Stock = '".$Stock."',Price='".$Price."' ,Description = '".$Description."',Image = '".$NewPhoto."' WHERE ProductID =".$ProductID;

	mysql_query($query);

	header('location:../product_update.php?'.'message=1'.'&ProductID='.$ProductID);
	
?>