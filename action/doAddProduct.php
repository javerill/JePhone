<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	include ("connect.php");

	if(!isset($_POST['txtProductName']))
	{
		header('location:../index.php');
		return;
	}

	$ProductName = trim($_POST['txtProductName']);
	$Category = $_POST['ddlCategory'];
	$Stock= trim($_POST['txtStock']);
	$Price= trim($_POST['txtPrice']);
	$Description= trim($_POST['txtDescription']);
	$Photo= $_FILES['filePhoto']['name'];
	$TypePhoto = $_FILES['filePhoto']['type'];

	//validasi semua field harus diisi kecuali description
	if($ProductName=="" || $Category=="" || $Stock=="" || $Price=="" || $Photo=="" )
	{
		header('location:../product_new.php?'.'message=All field must be filled, except Description.'.'&productname='.$ProductName.'&category='.$Category.'&stock='.$Stock.'&price='.$Price.'&description='.urlencode($Description));
		return;	
	}

	//validasi photo
	if($TypePhoto != 'image/png' && $TypePhoto != 'image/jpeg' && $TypePhoto != 'image/jpg')
	{
	    header('location:../product_new.php?'.'message=Product Image must be file image (jpeg, jpg, png).'.'&productname='.$ProductName.'&category='.$Category.'&stock='.$Stock.'&price='.$Price.'&description='.urlencode($Description));
		return;	
	}

	//validasi Stock harus numeric
	if (!is_numeric($Stock)) 
	{
		header('location:../product_new.php?'.'message=Stock must be numeric only.'.'&productname='.$ProductName.'&category='.$Category.'&stock='.$Stock.'&price='.$Price.'&description='.urlencode($Description));
		return;	
	}else
	{
		//validasi Stock harus lebih besar = 0
		if((int)$Stock<0)
		{
			header('location:../product_new.php?'.'message=Stock must greater than or equal zero.'.'&productname='.$ProductName.'&category='.$Category.'&stock='.$Stock.'&price='.$Price.'&description='.urlencode($Description));
		return;	
		}
	}

	//validasi Price harus numeric
	if (!is_numeric($Price)) 
	{
		header('location:../product_new.php?'.'message=Price must be numeric only.'.'&productname='.$ProductName.'&category='.$Category.'&stock='.$Stock.'&price='.$Price.'&description='.urlencode($Description));
		return;	
	}else
	{
		//validasi Stock harus lebih besar = 0
		if((int)$Price<0)
		{
			header('location:../product_new.php?'.'message=Price must greater than or equal zero.'.'&productname='.$ProductName.'&category='.$Category.'&stock='.$Stock.'&price='.$Price.'&description='.urlencode($Description));
		return;	
		}
	}


	$ProductImage="ProductImage/".$ProductName.(date("YmdHis")).".".pathinfo($_FILES["filePhoto"]["name"], PATHINFO_EXTENSION);
	move_uploaded_file($_FILES["filePhoto"]["tmp_name"],"../".$ProductImage);


	$query="INSERT INTO msproduct (CategoryID,Name,Stock,Price,Description,Image) 
	values('".$Category."','".$ProductName."','".$Stock."','".$Price."','".$Description."','".$ProductImage."')";

	mysql_query($query);

	header('location:../product_new.php?'.'message=1');
	
?>