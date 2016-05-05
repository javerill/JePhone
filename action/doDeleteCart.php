<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(isset($_GET['index']) && isset($_SESSION['ProductID'][$_GET['index']]))
	{
		unset($_SESSION['ProductID'][$_GET['index']]);
		unset($_SESSION['ProductImage'][$_GET['index']]);
		unset($_SESSION['ProductName'][$_GET['index']]);
		unset($_SESSION['ProductQuantity'][$_GET['index']]);
		unset($_SESSION['ProductPrice'][$_GET['index']]);
		unset($_SESSION['TotalPrice'][$_GET['index']]);

		$_SESSION['ProductID'] = array_values($_SESSION['ProductID']);
		$_SESSION['ProductImage'] = array_values($_SESSION['ProductImage']);
		$_SESSION['ProductName'] = array_values($_SESSION['ProductName']);
		$_SESSION['ProductQuantity'] = array_values($_SESSION['ProductQuantity']);
		$_SESSION['ProductPrice'] = array_values($_SESSION['ProductPrice']);
		$_SESSION['TotalPrice'] = array_values($_SESSION['TotalPrice']);

	}
	
	header('location:../cart.php?'.'message=2');
?>