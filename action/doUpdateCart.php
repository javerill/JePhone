<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_SESSION['UserLogin']) || $_SESSION['UserLogin']['Role']!='member' || !isset($_POST['hfProductID']))
	{
		header('location:../index.php');
		return;
	}
	include('connect.php');

	$ProductID = $_POST['hfProductID'];
	$Index = $_POST['hfIndex'];
	$Quantity = $_POST['txtQuantity'];

	//validasi quantity harus di isi
	if ($Quantity=="") 
	{
		header('location:../cart.php?'.'message=Quantity must be filled.');
		return;	
	}

	//validasi quantity harus numeric
	if (!is_numeric($Quantity)) 
	{
		header('location:../cart.php?'.'message=Quantity must be numeric only.');
		return;	
	}else
	{
		//validasi quantity harus lebih besar dari 0
		if ($Quantity<=0) 
		{
			header('location:../cart.php?'.'message=Quantity greater than 0.');
			return;	
		}
	}

	$query="SELECT * FROM msProduct where ProductID=".$ProductID;
	$result=mysql_query($query);

	$num_row= mysql_num_rows($result);

	if($num_row==0)
	{
		header('location:../index.php');
		return;
	}else
	{
		$row = mysql_fetch_assoc($result);
	}

	if(!isset($_SESSION['ProductID']))
	{
		$_SESSION['ProductID'] = array();
		$_SESSION['ProductImage'] = array();
		$_SESSION['ProductName'] = array();
		$_SESSION['ProductQuantity'] = array();
		$_SESSION['ProductPrice'] = array();
		$_SESSION['TotalPrice'] = array();	
	}

	for($a=0;$a<sizeof($_SESSION['ProductID']);$a++)
	{
		if($_SESSION['ProductID'][$a]==$ProductID)
		{	
			if($Quantity > $row['Stock'])
			{
				header('location:../cart.php?'.'message=This Product Stock ('.$row['Stock'].') is not available in the requested quantity.'.'&ProductID='.$ProductID);
				return;
			}else
			{
				$_SESSION['ProductQuantity'][$a]=$Quantity;
				$_SESSION['TotalPrice'][$a]=($Quantity*$row['Price']);
			}
			$isNever=1;
			break;
		}
	}

	header('location:../cart.php?'.'message=1');

?>
