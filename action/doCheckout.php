<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_SESSION['UserLogin']) || $_SESSION['UserLogin']['Role']!="member" || !isset($_SESSION['ProductID']) || sizeof($_SESSION['ProductID'])==0)
	{
		header('location:../index.php');
		return;
	}
	include ('connect.php');

	for($i=0;$i<sizeof($_SESSION['ProductID']);$i++)
	{
		$query="SELECT * FROM msProduct where ProductID=".$_SESSION['ProductID'][$i];
		$result=mysql_query($query);
		$row = mysql_fetch_assoc($result);

		if($_SESSION['ProductQuantity'][$i] > $row['Stock'])
		{
			header("location:../cart.php?message=Checkout Failed, ".$_SESSION['ProductName'][$i]." Stock(".$row['Stock'].") is not available in the requested quantity." );
			return;
			break;
		}
	}

	$query = "INSERT INTO trSalesheader(MemberID,SalesDate) VALUES (".$_SESSION['UserLogin']['MemberID'].",NOW())";
	mysql_query($query);
	
	$query = "SELECT SalesID FROM trSalesheader ORDER BY SalesID DESC LIMIT 1";

	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	
	for($i=0;$i<sizeof($_SESSION['ProductID']);$i++){
		$Quantity = $_SESSION['ProductQuantity'][$i];
		$ProductID = $_SESSION['ProductID'][$i];
		
		$query = "INSERT INTO trSalesdetail(SalesID,ProductID,Quantity) VALUES (".$row['SalesID'].",".$ProductID.",".$Quantity.")";
		mysql_query($query);
		
		$query = "UPDATE msProduct SET Stock = Stock - ".$Quantity." WHERE ProductID=".$ProductID;
		mysql_query($query);
			
	}
	
	unset($_SESSION['ProductID']);
	unset($_SESSION['ProductImage']);
	unset($_SESSION['ProductName']);
	unset($_SESSION['ProductQuantity']);
	unset($_SESSION['ProductPrice']);
	unset($_SESSION['TotalPrice']);	
	
	header("location:../cart.php?message=3");
	
?>