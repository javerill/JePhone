<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(isset($_SESSION['ProductID']))
	{
		unset($_SESSION['ProductID']);
		unset($_SESSION['ProductImage']);
		unset($_SESSION['ProductName']);
		unset($_SESSION['ProductQuantity']);
		unset($_SESSION['ProductPrice']);
		unset($_SESSION['TotalPrice']);	
	}

	header('location: ../cart.php');
?>