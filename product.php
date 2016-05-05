<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	$_SESSION['page']='product';
	include('header.php');
	include('action/connect.php');

	$page = 1;
										
	$search = "";
	$searchCategory = "";
	$categoryID = "";
	
	if(isset($_GET['txtSearch']))
		$search = $_GET['txtSearch'];

	if(isset($_GET['ddlSearchCategory']))
	{
		$query = "SELECT * FROM msCategory WHERE CategoryID = ".$_GET['ddlSearchCategory'];
		$resultCategory = mysql_query($query);

		if(!$resultCategory)
		{
			$searchCategory="";
		}else
		{
			$num_row = mysql_num_rows($resultCategory);

			if($num_row>0)
			{
				$searchCategory = $_GET['ddlSearchCategory'];
			}else
			{
				$searchCategory = "";
			}
		}
		$categoryID = $searchCategory;
	}else if(isset($_GET['categoryID']))
	{
		$query = "SELECT * FROM msCategory WHERE CategoryID = ".$_GET['categoryID'];
		$resultCategory = mysql_query($query);
		if(!$resultCategory)
		{
			$categoryID="";
		}
		else
		{
			$num_row = mysql_num_rows($resultCategory);

			if($num_row>0)
			{
				$categoryID = $_GET['categoryID'];
			}
			else
			{
				$categoryID="";
			}
	}
	}

	if($categoryID=="")
		$query="SELECT * FROM msproduct WHERE Name LIKE '%$search%'";
	else
		$query="SELECT * FROM msproduct WHERE Name LIKE '%$search%' AND CategoryID=".$categoryID;
	

	$result=mysql_query($query);
	$jumlahData=mysql_num_rows($result);
	$jumlahDataPerPage=12;
	$jumlahHalaman = ceil($jumlahData/$jumlahDataPerPage);

	if(isset($_GET['page']))
	{
		if(is_numeric($_GET['page']))
		{
			if($_GET['page']>$jumlahHalaman)
			{
				$page =$jumlahHalaman;
			}else if($_GET['page']>0)
			{
				$page=$_GET['page'];
			}
		}
	}

	if($categoryID=="")
	{
		$query = "SELECT * FROM msproduct WHERE Name LIKE '%$search%' ORDER BY ProductID DESC LIMIT ".(($page*$jumlahDataPerPage)-$jumlahDataPerPage).",$jumlahDataPerPage";
	}
	else
	{
		$query = "SELECT * FROM msproduct WHERE Name LIKE '%$search%' AND CategoryID=".$categoryID." ORDER BY ProductID DESC LIMIT ".(($page*$jumlahDataPerPage)-$jumlahDataPerPage).",$jumlahDataPerPage";
	}

	$resultProduct=mysql_query($query);
	$i=1;

?>
	
	<div class="container-fluid" id="content" >
		<div class="row">
			<div class="col-md-3 col-md-offset-1">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><span class=" glyphicon glyphicon-search"></span> Search</h3>
					</div>
					<div class="panel-body">
						<form method="get">
							<label>Keyword</label>
							<div class="input-group">
								<input type="text" class="form-control" name="txtSearch" placeholder="Enter Product Name" value=<?php echo $search;?> >
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
	                        			<option value="<?php echo $r['CategoryID']?>" <?php if($searchCategory==$r['CategoryID']){echo 'selected';} ?> >
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
						<a href="product.php?categoryID=" class="list-group-item
							<?php 
								if(!isset($_GET['ddlSearchCategory']))
								{ 
									if(!isset($_GET['categoryID']) || $categoryID=="")
									{
										echo'list-group-item-info';
									}
								}else if($searchCategory=="")
								{
									echo'list-group-item-info';
								}
							?>" >
							All Products <span class="badge">
							<?php 
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
                    			<a href="product.php?categoryID=<?php echo $r['CategoryID']?>" class="list-group-item
	                    			<?php 
										if(!isset($_GET['ddlSearchCategory']))
										{ 
											if(isset($_GET['categoryID']) && $categoryID==$r['CategoryID'])
											{
												echo 'list-group-item-info';
											}
										}else if($searchCategory==$r['CategoryID'])
										{
											echo 'list-group-item-info';
										}
									?>" >                  
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
					<div class="panel-heading" align="center">
						<strong> 
							<h3 class="panel-title">
								<?php
									if($categoryID=="")
									{
										echo "All Products";
									}else
									{
										$row = mysql_fetch_array($resultCategory);
										echo $row["CategoryName"];
									}
								?>
							</h3>
						</strong>
					</div>
					<div class="panel-body">
						<div class="col-md-12">
                    		<?php
                    			if(isset($_GET['message']) && isset($_SESSION['UserLogin']) && $_SESSION['UserLogin']['Role']=='admin')
                    			{
                    		?>
				                <div class="alert alert-success">
				                    <strong><span class="glyphicon glyphicon-ok"></span> <?php echo $_GET['message'];?>.</strong>
				                </div>
    	                    <?php }?>
			            </div>
						<div class="row">
							<?php

							if(mysql_num_rows($resultProduct)==0)
							{ ?>
								<div class="col-sm-12 col-md-12" align="center">
									<h4>- No Product Found - </h4>
								</div>
							<?php }else
							{
								while($r = mysql_fetch_array($resultProduct))
								{ ?>
									<div class="col-sm-4 col-md-4">
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
									if ($i%3==0) 
									{
										echo '</div> <div class="row">';	
									}

									$i++;
								}
							}
							?>
						</div>
						<?php
							if(isset($_SESSION['UserLogin']))
							{
								if($_SESSION['UserLogin']['Role']=='admin')
								{ ?>
									<div class="row" align="center">
										<a class="btn btn-primary" href="product_new.php?category=<?php echo $categoryID;?>">
											Add New Product
										</a>
									</div>
							<?php }
							}
						?>
					</div>
					<div class="panel-footer" align="right">
						<ul class="pagination" style="margin-top:0px;margin-bottom:0px;">
							<?php
								if($page==1)
								{
									echo '<li class="disabled"><a>&laquo;</a></li>';
								}
								else
								{
									if(isset($_GET['ddlSearchCategory']))
									{
										echo '<li> <a href="product.php?txtSearch='.$search.'&page='.($page-1).'&ddlSearchCategory='.$categoryID.'">&laquo;</a></li>';
									}else
									{
										echo '<li> <a href="product.php?txtSearch='.$search.'&page='.($page-1).'&categoryID='.$categoryID.'">&laquo;</a></li>';
									}
								}

								for($i = 1; $i<=$jumlahHalaman;$i++)
								{
									if($page==$i)
									{
										echo "<li class='active'><a>$i</a></li>";
									}
									else
									{
										if(isset($_GET['ddlSearchCategory']))
										{
											echo "<li><a href='product.php?txtSearch=$search&page=$i&ddlSearchCategory=$categoryID'>$i</a></li>";
										}else
										{
											echo "<li><a href='product.php?txtSearch=$search&page=$i&categoryID=$categoryID'>$i</a></li>";
										}
									}
								}

								if($page==$jumlahHalaman || $jumlahHalaman==0)
								{
									echo '<li class="disabled"><a>&raquo;</a></li>';
								}
								else
								{	
									if(isset($_GET['ddlSearchCategory']))
									{
										echo '<li> <a href="product.php?txtSearch='.$search.'&page='.($page+1).'&ddlSearchCategory='.$categoryID.'">&raquo;</a></li>';
									}else
									{
										echo '<li> <a href="product.php?txtSearch='.$search.'&page='.($page+1).'&categoryID='.$categoryID.'">&raquo;</a></li>';
									}

								}
							?>
	                  	</ul>
					</div>
				</div>
			</div>
        </div><!--end row-->
	</div>

<?php
	include('footer.php');
?>