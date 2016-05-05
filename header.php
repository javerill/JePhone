<html>
<head>
	<title>JePhone - Toko Online Gadget Kesukaanmu!</title>

	<link rel="shortcut icon" href="asset/img/logo.png" type="image/x-icon">
	<link rel="icon" href="asset/img/logo.png" type="image/x-icon">

	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">

	<script type="text/javascript" src="asset/js/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="asset/js/bootstrap.js"></script>

	<style>
		.navbar-default{
			background: #337ab7;
			border-bottom: 1 white solid;
			position: fixed!important;
			z-index: 999999!important;
			width: 100%!important;
		}

		.navbar{
			margin: 0px!important;
			padding: 0px!important;
		}

		.navbar-default .navbar-nav a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus{
			color: white!important;
			background-color: transparent;
		}

		.navbar-default .navbar-brand {
		  color: white;
		}
		.navbar-default .navbar-brand:hover,
		.navbar-default .navbar-brand:focus {
		  color: white;
		  background-color: transparent;
		}

		.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus{
			background-color: transparent!important;
			border-bottom: 2px white solid;	
		}

		.navbar-default .navbar-nav  a:hover{
			background-color: transparent!important;
			border-bottom: 2px white solid;	
		}

		.navbar-nav > li > a {
			padding-top: 15px;
			padding-bottom: 5px!important;
			padding-left: 0px!important;
			padding-right: 0px!important;
			margin-left: 15px;
			margin-right: 15px;
		}

		.navbar-default .navbar-toggle {
		  border-color: white;
		}
		.navbar-default .navbar-toggle:hover,
		.navbar-default .navbar-toggle:focus {
		  background-color: white;
		}
		.navbar-default .navbar-toggle .icon-bar {
		  background-color: #888;
		}
		.navbar-default .navbar-collapse,
		.navbar-default .navbar-form {
		  border-color: #e7e7e7;
		}
		.navbar-default .navbar-nav > .open > a,
		.navbar-default .navbar-nav > .open > a:hover,
		.navbar-default .navbar-nav > .open > a:focus {
		  color: #555;
		  background-color: white;
		}

	</style>
</head>
<body>
	<nav id="nav-header" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
				<img src="asset/img/logo.png" class="pull-left" width="50px" height="50px" style="padding:8px;">
				<a class="navbar-brand" href="index.php">JePhone</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">

			<ul class="nav navbar-nav navbar-right">
				<li <?php if(isset($_SESSION['page']) && $_SESSION['page']=='home'){echo "class='active'";}?> >
					<a href="index.php"><span class="glyphicon glyphicon-home"></span> Home <span class="sr-only">(current)</span></a>
				</li>
				<li <?php if(isset($_SESSION['page']) && $_SESSION['page']=='aboutus'){echo "class='active'";}?> >
					<a href="AboutUs.php"><span class="glyphicon glyphicon-file"></span> About Us</a>
				</li>
				<li <?php if(isset($_SESSION['page']) && $_SESSION['page']=='product'){echo "class='active'";}?> >
					<a href="product.php"><span class="glyphicon glyphicon-briefcase"></span> Products</a>
				</li>
				<?php
					if(!isset($_SESSION['UserLogin']))
					{
				?>

				<li <?php if(isset($_SESSION['page']) && $_SESSION['page']=='register'){echo "class='active'";}?> >
					<a href="register.php"><span class="glyphicon glyphicon-flag"></span> Register</a>
				</li>
				<li <?php if(isset($_SESSION['page']) && $_SESSION['page']=='login'){echo "class='active'";}?> >
					<a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
				</li>
				
				<?php } else if($_SESSION['UserLogin']['Role']=='admin') { ?>
				<li <?php if(isset($_SESSION['page']) && $_SESSION['page']=='newProduct'){echo "class='active'";}?> >
					<a href="product_new.php"><span class="glyphicon glyphicon-plus"></span> Add Product</a>
				</li>
				<li <?php if(isset($_SESSION['page']) && $_SESSION['page']=='viewTransaction'){echo "class='active'";}?> >
					<a href="ViewTransaction.php"><span class="glyphicon glyphicon-eye-open"></span> View Transaction</a>
				</li>
				<li <?php if(isset($_SESSION['page']) && $_SESSION['page']=='member'){echo "class='active'";}?> >
					<a href="member_list.php"><span class="glyphicon glyphicon-user"></span> Member List</a>
				</li>
				<li>
					<a href="action/doLogout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
				</li>
				<?php } else {?>

				<li <?php if(isset($_SESSION['page']) && $_SESSION['page']=='profile'){echo "class='active'";}?> >
					<a href="member_detail.php"><span class="glyphicon glyphicon-edit"></span> Edit Profile </a>
				</li>

				<li <?php if(isset($_SESSION['page']) && $_SESSION['page']=='cart'){echo "class='active'";}?> >
					<a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</a>
				</li>

				<li>
					<a href="action/doLogout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
				</li>

				<?php } ?>
			</ul>
			</div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>
    