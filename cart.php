<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_SESSION['UserLogin']) || $_SESSION['UserLogin']['Role']!='member')
	{
		header('location:index.php');
		return;
	}

	$_SESSION['page'] = 'cart';
	include('header.php');
?>
	
<div class="container-fluid" id="content" >
	<div class="row">
		<div class="col-md-3 col-md-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><span class=" glyphicon glyphicon-search"></span> Search</h3>
				</div>
				<div class="panel-body">
					<form method="get" action="product.php">
						<label>Keyword</label>
						<div class="input-group">
							<input type="text" class="form-control" name="txtSearch" placeholder="Enter Product Name" >
							<span class="input-group-addon"><span class=" glyphicon glyphicon-search"></span></span>
						</div>
						<label style="margin-top: 5px;">Category</label>
						<select class="form-control" id="ddlSearchCategory" name="ddlSearchCategory">
							<option value="">- All Products -</option>
							<?php
                        		include('action/connect.php');
                        		$query = "SELECT * FROM msCategory"." ORDER BY CategoryName ASC";
                        		$result = mysql_query($query);
                        		
                        		while($r = mysql_fetch_array($result))
                        		{ ?>
                        			<option value="<?php echo $r['CategoryID']?>" >
                        				<?php echo $r['CategoryName']?>
                        			</option>
                    		<?php } 
                        	?>
						</select>
						<br>
						<button type="submit" class="btn btn-primary btn-block">Search</button>
					</form>
				</div>
			</div>

			<div class="panel panel-primary">
				<div class="panel-heading" >
				<h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> Categories</h3>
				</div>
				<div class="panel-body list-group" style="padding:0;">
					<a href="product.php?categoryID=" class="list-group-item">
						All Products 
							<span class="badge"><?php 
								include('action/connect.php');
								$query = "SELECT * FROM msProduct";
								$result = mysql_query($query);
								echo mysql_num_rows($result)?>
							</span>
					</a>
					<?php
                		include('action/connect.php');
                		$query = "SELECT * FROM msCategory"." ORDER BY CategoryName ASC";
                		$result = mysql_query($query);
                		
                		while($r = mysql_fetch_array($result))
                		{ ?>
                			<a href="product.php?categoryID=<?php echo $r['CategoryID']?>" class="list-group-item">
								<?php 
									if($r['CategoryName'] == "Apple")
										{
											?><span class="badge"><?php
											$query = "SELECT * FROM msProduct WHERE CategoryID = 2";
                    						$resultApple = mysql_query($query); 
											echo mysql_num_rows($resultApple)?></span>
											<?php
										}
										else if($r['CategoryName'] == "Asus")
										{
											?><span class="badge"><?php
											$query = "SELECT * FROM msProduct WHERE CategoryID = 7";
                    						$resultAsus = mysql_query($query); 
											echo mysql_num_rows($resultAsus)?></span>
											<?php
										}
										else if($r['CategoryName'] == "Blackberry")
										{
											?><span class="badge"><?php
											$query = "SELECT * FROM msProduct WHERE CategoryID = 3";
                    						$resultBB = mysql_query($query); 
											echo mysql_num_rows($resultBB)?></span>
											<?php
										}
										else if($r['CategoryName'] == "Motorola")
										{
											?><span class="badge"><?php
											$query = "SELECT * FROM msProduct WHERE CategoryID = 8";
                    						$resultMotorola = mysql_query($query); 
											echo mysql_num_rows($resultMotorola)?></span>
											<?php
										}
										else if($r['CategoryName'] == "Nokia")
										{
											?><span class="badge"><?php
											$query = "SELECT * FROM msProduct WHERE CategoryID = 5";
                    						$resultNokia = mysql_query($query); 
											echo mysql_num_rows($resultNokia)?></span>
											<?php
										}
										else if($r['CategoryName'] == "Samsung")
										{
											?><span class="badge"><?php
											$query = "SELECT * FROM msProduct WHERE CategoryID = 4";
                    						$resultSamsung = mysql_query($query); 
											echo mysql_num_rows($resultSamsung)?></span>
											<?php
										}
										else
										{
											?><span class="badge"><?php
											$query = "SELECT * FROM msProduct WHERE CategoryID = 6";
                    						$resultSony = mysql_query($query); 
											echo mysql_num_rows($resultSony)?></span>
											<?php
										}
									echo $r['CategoryName']
								?>
                			</a>
            		<?php } 
                	?>
				</div>
			</div>
		</div>

		<div class="col-md-7">
			<div class="panel panel-primary">
			    <div class="panel-heading" align="center" >
			    	<strong>
			    		<h3 class="panel-title">
			                Shopping Cart
			            </h3>
			        </strong>
			    </div>
			    <div class="panel-body">
			    <div class="row">
			    	<div class="col-md-12">
                		<?php
                			if(isset($_GET['message']) && $_GET['message']==1)
                			{
                		?>
		                <div class="alert alert-success">
		                    <strong><span class="glyphicon glyphicon-ok"></span> Update Cart Success!</strong>
		                </div>
		                <?php }else if(isset($_GET['message']) && $_GET['message']==2)
                			{
                		?>
		                <div class="alert alert-success">
		                    <strong><span class="glyphicon glyphicon-ok"></span> Delete Cart Success!</strong>
		                </div>
		                <?php }else if(isset($_GET['message']) && $_GET['message']==3)
                			{
                		?>
		                <div class="alert alert-success">
		                    <strong><span class="glyphicon glyphicon-ok"></span> Checkout Success. Thank You for buying with JePhone!</strong>
		                </div>
		                <?php }else if(isset($_GET['message'])){
		                ?>
		                <div class="alert alert-danger">
		                    <span class="glyphicon glyphicon-remove"></span><strong> <?php echo $_GET['message'];?></strong>
		                </div>
		                <?php }?>
		            </div>
			    </div>
		        <div class="row">
		        	<div class="row">		
						<div class="col-sm-12 col-md-12">
							<?php
							if(!isset($_SESSION['ProductID']) || sizeof($_SESSION['ProductID'])==0)
							{ ?>

								<div class="alert alert-info">
									<h4 style="margin-top:0px;margin-bottom:0px;">
									Your shopping cart is empty.
									</h4>
								</div>
								<div align="center">
									<a href="product.php" class="btn btn-primary">Continue Shopping</a>
								</div>

							<?php } 
							else
							{?>
							<div class="col-md-12 table-responsive">
								<table class="table table-striped table-condensed table-hover table-bordered panel-primary">
									<thead class="panel-heading">
										<tr>
											<th style="vertical-align:middle;text-align:center;">
												#
											</th>
											<th style="vertical-align:middle;text-align:center;">
												Image
											</th>
											<th style="vertical-align:middle;text-align:center;">
												Name
											</th>
											<th style="vertical-align:middle;text-align:center;">
												Price
											</th>
											<th style="vertical-align:middle;text-align:center;">
												Quantity
											</th>
											<th style="vertical-align:middle;text-align:center;">
												Total Price
											</th>
											<th style="vertical-align:middle;text-align:center;">
												Action
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$grandTotal=0;
											for($i=0; $i< sizeof($_SESSION['ProductID']); $i++)
											{ 
												$grandTotal=$grandTotal+$_SESSION['TotalPrice'][$i];
												?>
												<form method="post" action="action/doUpdateCart.php">
													<tr>
														<td style="vertical-align:middle;text-align:center;">
															<?php echo $i+1;?>
															<input type="hidden" name="hfProductID" id="hfProductID" value="<?php echo $_SESSION['ProductID'][$i]?>" >
															<input type="hidden" name="hfIndex" id="hfIndex" value="<?php echo $i;?>" >
														</td>
														<td style="vertical-align:middle;text-align:center;">
															<a href="product_detail.php?ProductID=<?php echo $_SESSION['ProductID'][$i];?>">
																<img width="75" height="75" src="<?php echo $_SESSION['ProductImage'][$i];?>">
															</a>
														</td>
														<td style="vertical-align:middle;text-align:center;">
															<a href="product_detail.php?ProductID=<?php echo $_SESSION['ProductID'][$i];?>">
																<?php echo $_SESSION['ProductName'][$i]?>
															</a>
														</td>
														<td style="vertical-align:middle;text-align:center;">
															Rp. <?php echo number_format($_SESSION['ProductPrice'][$i],2,",",".");?>
														</td>
														<td style="vertical-align:middle;" align="center">
															<input class="form-control" type="text" name="txtQuantity" id="txtQuantity" value="<?php echo $_SESSION['ProductQuantity'][$i]?>" style="text-align:center; width:80px; margin:0px;" />
														</td>
														<td style="vertical-align:middle; text-align:center;">
															Rp. <?php echo number_format($_SESSION['TotalPrice'][$i],2,",",".");?>
														</td>
														<td style="vertical-align:middle; text-align:center;">
															<button style="width: 75%" title="Update" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Update</button>
															<a style="margin-top: 5px; width: 75%" Title="Remove" href="action/doDeleteCart.php?index=<?php echo $i;?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete
															</a>
														</td>
													</tr>
												</form>
										<?php }
										?>
									</tbody>
								</table>
								</div>
								<div class="col-sm-12 col-md-12">
									<div class="alert alert-info" style="margin-top:10px;margin-bottom:10px;" align="right">
										<h4 style="margin-top:0px;margin-bottom:0px;">Total Price : IDR <?php echo number_format($grandTotal,2,",",".");?></h4>
									</div>
									<div align="center">
										<a href="action/doClearCart.php" class="btn btn-Danger"><span class="glyphicon glyphicon-trash"></span> Clear Cart</a>
										<a href="product.php" class="btn btn-primary"><span class="glyphicon glyphicon-share-alt"></span> Continue Shopping</a>
										<a href="action/doCheckout.php" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> Check Out</a>					
									</div>
								</div>				
							<?php }?>
						</div>
					</div>
		        </div>
		    </div>	
		</div>	
    </div>
</div>

<?php
	include('footer.php');
?>