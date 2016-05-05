<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	include('connect.php');

	if(!isset($_SESSION['UserLogin']) || $_SESSION['UserLogin']['Role']!='member' || !isset($_POST['hfProductID']))
	{
		header('location:../index.php');
		return;
	}

	$isNever=0;

	$ProductID = $_POST['hfProductID'];
	$Quantity = $_POST['txtQuantity'];

	//validasi quantity harus di isi
	if ($Quantity=="") 
	{
		header('location:../product_detail.php?'.'message=Quantity must be filled.'.'&ProductID='.$ProductID);
		return;	
	}

	//validasi quantity harus numeric
	if (!is_numeric($Quantity)) 
	{
		header('location:../product_detail.php?'.'message=Quantity must be numeric only.'.'&ProductID='.$ProductID);
		return;	
	}else
	{
		//validasi quantity harus lebih besar dari 0
		if ($Quantity<=0) 
		{
			header('location:../product_detail.php?'.'message=Quantity greater than 0.'.'&ProductID='.$ProductID);
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
			$tempQuantity = (int)$_SESSION['ProductQuantity'][$a]+$Quantity;

			//validasi quantity harus lebih kecil dari stock
			if($tempQuantity > $row['Stock'])
			{
				header('location:../product_detail.php?'.'message=This Product Stock('.$row['Stock'].') is not available in the requested quantity.'.'&ProductID='.$ProductID);
				return;
			}else
			{
				$_SESSION['ProductQuantity'][$a]=(int)$_SESSION['ProductQuantity'][$a]+$Quantity;
				$_SESSION['TotalPrice'][$a]=(int)$_SESSION['TotalPrice'][$a]+($Quantity*$row['Price']);
			}
			$isNever=1;
			break;
		}
	}

	if($isNever==0)
	{
		if($Quantity > $row['Stock'])
		{
			header('location:../product_detail.php?'.'message=This Product Stock('.$row['Stock'].') is not available in the requested quantity.'.'&ProductID='.$ProductID);
			return;
		}
		array_push($_SESSION['ProductID'] , $ProductID);
		array_push($_SESSION['ProductImage'] , $row['Image']);
		array_push($_SESSION['ProductName'] , $row['Name']);
		array_push($_SESSION['ProductQuantity'] , $Quantity);
		array_push($_SESSION['ProductPrice'] , $row['Price']);
		array_push($_SESSION['TotalPrice'] , ($row['Price'] * $Quantity));

	}
	header('location:../product_detail.php?'.'message=1'.'&ProductID='.$ProductID);

?>
