<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	
	include('action/connect.php');
	$query = "SELECT * FROM msproduct ORDER BY ProductID DESC LIMIT 0,8";

	$resultProduct = mysql_query($query);
	$i = 1;
	
	$_SESSION['page']='home';
	include('header.php');
?>

<link rel="stylesheet" href="asset/owlcarousel/owl.carousel/assets/owl.carousel.css"/>
<script src="asset/owlcarousel/owl.carousel/owl.carousel.min.js"></script>

<div class="jumbotron">
	<div class="container">
		<h1 class="text-center">
			Welcome, <?php 
				if(isset($_SESSION['UserLogin']))
				{
					echo $_SESSION['UserLogin']['Fullname'] . "!";
				}
				else
				{
					echo "Guest!";
				}
			?>
		</h1>
		<p class="text-center">
			Have a nice shopping with JePhone!
		</p>
	</div>
	<div class="owl-carousel owl-theme">
		<div class="imageCarousel"><img src="asset/img/iPadPro.jpg" alt="iPadPro.jpg" title="iPad Pro" /></div>
		<div class="imageCarousel"><img src="asset/img/s6edge.jpg" alt="s6edge.jpg" title="Samsung Galaxy S6 Edge"/></div>
		<div class="imageCarousel"><img src="asset/img/iPhone6.jpg" alt="iPhone6.jpg" title="iPhone 6s" /></div>
		<div class="imageCarousel"><img src="asset/img/blackberryPorsche.jpg" alt="blackberryPorsche.jpg" title="Blackberry Porsche" /></div>
		<div class="imageCarousel"><img src="asset/img/htcOneA9.jpg" alt="htcOneA9.jpg" title="HTC One A9" /></div>
	</div>
</div>

<div class="container-fluid">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading" align="center">
				<strong> 
					<div class="panel-title" style="font-size: 24px;">
						Top Selling Products
					</div>
				</strong>
			</div>
			<div class="panel-body">
				<div class="row">
					<?php
						if(mysql_num_rows($resultProduct) == 0)
						{ 
						?>
						<div class="col-sm-12 col-md-12" align="center">
							<h4>- No Product Found - </h4>
						</div>
					<?php }
					else
					{
						while($r = mysql_fetch_array($resultProduct))
						{ ?>
							<div class="col-sm-3 col-md-3">
				            	<div class="panel panel-primary">
			            			<div class="panel-heading">
				            			<a style="color:white; text-decoration:none;" href="product_detail.php?ProductID=<?php echo $r['ProductID']?>">
				            				<h3 class="panel-title" align="center"> <?php echo $r['Name']; ?></h3>
					            		</a>
			            			</div>
					            	<a class="thumbnail" style="margin:0px;" href="product_detail.php?ProductID=<?php echo $r['ProductID']?>">
					            		<img style="max-width: 100%; height:200px;" src="<?php echo $r['Image']; ?>" />
				            		</a>
					            	<div align="center">
						            	<h4>
					            			Rp. <?php echo number_format($r['Price'],2,",",".");?>
					            		</h4>
						            	<p>
						            		<a href="product_detail.php?ProductID=<?php echo $r['ProductID']?>" class="btn btn-primary btn-block" style="max-width:90%;" role="button">
						            	 		Detail Product
						            	 	</a>
					            	 	</p>
				            	 	</div>
				            	 </div>
				            </div>
				         <?php
							if ($i%4==0) 
							{
								echo '</div> <div class="row">';	
							}
							$i++;
						}
					}
					?>
				</div>
			</div>
			<div class="panel-footer" align="right">
				<a class="btn btn-primary" href="product.php">
					View More Products
				</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var owl = $('.owl-carousel');
		owl.owlCarousel({
			items: 3,
			loop: true,
		    margin: 10,
		    autoplay: true,
		    autoplayTimeout: 2000,
		    autoplayHoverPause: true
		});
	});
</script>

<?php
	include('footer.php');
?>