<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	$ProductID = $_GET['ProductID'];

	include('action/connect.php');

	$query = "SELECT ProductID,a.CategoryID,b.CategoryName,Name,Stock,Image,Price,Description FROM msProduct a
	JOIN msCategory b ON a.CategoryID = b.CategoryID
	WHERE ProductID = $ProductID";

	$result = mysql_query($query);
	$num_row = mysql_num_rows($result);

	if($num_row==0)
	{
		header('location:product.php');
		return;
	}
	else
	{
		$row = mysql_fetch_assoc($result);
	}
	
	$_SESSION['page']='product';
	include('header.php');
?>
	
	<style>
		/*
			Source = http://codepen.io/magnus16/pen/buGiB
		*/
		.titleBox {
		    background-color:#fdfdfd;
		    padding:10px;
		}
		.titleBox label{
		  color:#444;
		  margin:0;
		  display:inline-block;
		}
		.commentList {
		    padding:0;
		    list-style:none;
		    max-height:400px;
		    overflow:auto;
		}
		.commentList li {
		    margin:0;
		    margin-top:10px;
		}
		.commentList li > div {
		    display:table-cell;
		}
		.sub-text {
		    color:#aaa;
		    font-family:verdana;
		    font-size:11px;
		}
		.actionBox {
		    border-top:1px dotted #bbb;
		    padding:10px;
		}
	</style>

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
				                Detail Product
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
			                    <strong><span class="glyphicon glyphicon-ok"></span> Add to Cart Success!</strong>
			                </div>
			                <?php }else if(isset($_GET['message'])){
			                ?>
			                <div class="alert alert-danger">
			                    <span class="glyphicon glyphicon-remove"></span><strong> <?php echo $_GET['message'];?></strong>
			                </div>
			                <?php }?>
			            </div>
				    </div>
				    	<ol class="breadcrumb">
						  <li><a href="product.php">Product</a></li>
						  <li><a href="product.php?categoryID=<?php echo $row['CategoryID'];?>"> <?php echo $row['CategoryName'];?> </a></li>
						  <li class="active"><?php echo $row['Name'];?></li>
						</ol>
				        <div class="row">		
				        	<div class="col-sm-12 col-md-6">
				        		<a class="thumbnail">
							      <img class="img-responsive" src="<?php echo $row['Image'];?>">
							    </a>
							</div>
							<div class="col-sm-12 col-md-6" style="padding-left:0">
				        		<div class="panel panel-default">
								  <div class="panel-body">
								  	<div class="row">
								    	<div class="col-md-5">
								    		<h5><strong>Product Name </strong></h5>
								    	</div>
								    	<div class="col-md-7">
								    		<h5>
								    			: <?php echo $row['Name'];?>
								    		</h5>
								    	</div>
								    </div>
								    <div class="row">
								    	<div class="col-md-5">
								    		<h5><strong>Price </strong></h5>
								    	</div>
								    	<div class="col-md-7">
								    		<h5>
						            			: Rp. <?php echo number_format($row['Price'],2,",",".");?>
								    		</h5>
								    	</div>
								    </div>
								    <div class="row">
								    	<div class="col-md-5">
								    		<h5><strong>Stock</strong></h5>
								    	</div>
								    	<div class="col-md-7">
								    		<h5>: <?php echo $row['Stock']; if($row['Stock']>0)echo " (Available)";else echo " (Out of stock)";?></h5>
								    	</div>
								    </div>
								    <div class="row">
								    	<div class="col-md-5">
								    		<h5><strong>Description</strong></h5>
								    	</div>
								    	<div class="col-md-7">
								    		<h5 class="text-justify">:</h5>
								    	</div>
								    	<div class="col-md-12">
								    		<h5 class="text-justify"><?php echo $row['Description'];?></h5>
								    	</div>
								    </div>
								</div>
								<?php
									if(isset($_SESSION['UserLogin']))
									{ 
										if($_SESSION['UserLogin']['Role']=='admin')
										{ ?>
										<div class="panel-footer" align="center" id="review">
											<form style="margin:0px" class="form-inline" method="post" action="action/doDeleteProduct.php">
												<div class="form-group" align="center">
													<input type="hidden" name="hfProductID" id="hfProductID" value="<?php echo $row['ProductID']; ?>" />
													<input type="hidden" name="hfPhoto" id="hfPhoto" value="<?php echo $row['Image']; ?>" />
												
													<a title="Edit Product" class="btn btn-primary" href="product_update.php?ProductID=<?php echo $row['ProductID'];?>">
														<span class="glyphicon glyphicon-pencil"></span> Edit
													</a>
													<button title="Delete Product" type="submit" class="btn btn-danger">
														<span class="glyphicon glyphicon-trash"></span> Delete
													 </button>
												</div>	
											</form>
								  		</div>
										
								<?php }else
										{?>
										<div class="panel-footer" align="center" id="review">
											<form method="post" class="form-inline" style="margin:0px;" action="action/doAddCart.php">
												<input type="hidden" name="hfProductID" id="hfProductID" value="<?php echo $row['ProductID']; ?>" />
												<div class="form-group" align="center">
													<input type="text" placeholder="Quantity" style="max-width:80px; text-align:center" name="txtQuantity" id="txtQuantity" class="form-control"> 
													<button type="submit" class="btn btn-primary"> Add to Cart</button>
												</div>	
											</form>
								  		</div>
								<?php }
								}?>							
								</div>
							</div>
						</div>
					</div>
					<div class="panel-footer" style="background-color:white" >
						<div class="row">
							<div class="col-md-12">
	                    		<?php
	                    			if(isset($_GET['messageReview']) && $_GET['messageReview']==1)
	                    			{
	                    		?>
				                <div class="alert alert-success">
				                    <strong><span class="glyphicon glyphicon-ok"></span> Add Review Success!</strong>
				                </div>
				                <?php }else if(isset($_GET['messageReview']) && $_GET['messageReview']==2){
				                ?>
				                <div class="alert alert-success">
				                    <span class="glyphicon glyphicon-ok"></span><strong> Delete Review Success!</strong>
				                </div>
				                <?php }else if(isset($_GET['messageReview']) && $_GET['messageReview']==3){
				                ?>
				                <div class="alert alert-success">
				                    <span class="glyphicon glyphicon-ok"></span><strong> Update Review Success!</strong>
				                </div>
				                <?php }else if(isset($_GET['messageReview'])){
				                ?>
				                <div class="alert alert-danger">
				                    <span class="glyphicon glyphicon-remove"></span><strong> <?php echo $_GET['messageReview'];?></strong>
				                </div>
				                <?php }?>
				            </div>
			            </div>
						<div class="thumbnail">
						    <div class="titleBox">
						      <label>Review Product</label>
						    </div>
						    <div class="actionBox">
						        <ul class="commentList">
						        	<?php
						        		$query="SELECT CommentID, a.MemberID, b.Username,b.Image, Content, DATE_FORMAT( CommentDate,  '%e %M %Y' ) AS NewCommentDate FROM trcomment a JOIN msMember b ON a.MemberID = b.MemberID WHERE ProductID = ".$ProductID." ORDER BY CommentID DESC";
										$result=mysql_query($query);
										$num_row= mysql_num_rows($result);

										if($num_row==0)
										{ ?>
											<div align="center">
												- No Review -
											</div>
										<?php }else
										{
											$i=1;

											while($r = mysql_fetch_array($result))
											{ ?>
											<li class="list-group-item">
												<div class="row" id="<?php echo $r['CommentID'];?>">
													<div style="float:left;margin-right:5px;">
														<img width="40px" height="40px" src="<?php echo $r['Image'];?>" />
								                    </div>
								                    <div style="float:left;">
									                    <strong><?php echo $r['Username'];?></strong>
									                    <br>
									                    <span class="date sub-text">on <?php echo $r['NewCommentDate'];?></span>
								                	</div>
								                </div>
								                
								                <div style="display:block">
								                	<p>
								                		<?php echo $r['Content'];?>
								                		<hr style="margin:0px;"/>
								                	</p>
								                	<?php
								                		if(isset($_SESSION['UserLogin']) && $r['MemberID']==$_SESSION['UserLogin']['MemberID'])
									                	{
									                ?>
									                    <form style="margin:0px;text-align:right;" class="form-inline" method="post" action="action/doDeleteReview.php">
								                    		<input type="hidden" name="hfCommentID" id="hfCommentID" value="<?php echo $r['CommentID']; ?>" />
															<input type="hidden" name="hfProductID" id="hfProductID" value="<?php echo $ProductID; ?>" />
														
															<a title="Edit Review" class="btn btn-primary" href="comment_detail.php?ProductID=<?php echo $ProductID;?>&ReviewID=<?php echo $r['CommentID']?>#<?php echo $r['CommentID']?>">
																<span class="glyphicon glyphicon-pencil"></span>
															</a>
															<button title="Delete Review" type="submit" class="btn btn-danger">
																<span class="glyphicon glyphicon-trash"></span>
															 </button>
									                    </form>
									                <?php
									                	}
									                ?>
								                </div>
								             </li>
											<?php }
										}
						        	?>
						        </ul>
						        <?php
						        	if(isset($_SESSION['UserLogin']))
						        	{
						        ?>
							        <hr style="margin:10px;" />
							        <form method="post" action="action/doAddReview.php" style="margin:0px;">
							        	<input type="hidden" name="hfProductID" id="hfProductID" value="<?php echo $ProductID?>" />
							        	<div class="form-group" style="margin-bottom:5px;">
							        		<input value="<?php if(isset($_GET['content'])){echo $_GET['content'];} ?>" name="txtContent" id="txtContent" class="form-control" type="text" placeholder="Enter your review" />
							            </div>
							            <div class="form-group" align="right" style="margin:0px;">
							                <button type="submit" class="btn btn-primary" style="margin-top: 7px;">Add Review</button>
							            </div>
							        </form>
						        <?php }?>
						    </div>
						</div>
					</div>
				</div>
			</div>
        </div><!--end row-->
	</div>

<?php
	include('footer.php');
?>