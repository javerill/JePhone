<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_SESSION['UserLogin']) || $_SESSION['UserLogin']['Role']!='admin' || !isset($_GET['ProductID']))
	{
		header('location:index.php');
		return;
	}

	$ProductID = $_GET['ProductID'];

	include('action/connect.php');

	$query = "SELECT * FROM msProduct WHERE ProductID = $ProductID";
	$result = mysql_query($query);
	$num_row = mysql_num_rows($result);

	if($num_row==0)
	{
		header('location:index.php');
		return;
	}
	else
	{
		$row = mysql_fetch_assoc($result);
	}

	$_SESSION['page']='product';
	include('header.php');
?>

<div class="container-fluid" id="content" >
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading" align="center">
                    <h3 class="panel-title" style="font-size:50px;">Edit Product</h3>
                </div><!--end of heading-->
                
                <div class="panel-body" style="padding:30px;">
                	<div class="col-md-12">
                		<?php
                			if(isset($_GET['message']) && $_GET['message']==1)
                			{
                		?>
		                <div class="alert alert-success">
		                    <strong><span class="glyphicon glyphicon-ok"></span> Update Product Success.</strong>
		                </div>
		                <?php }else if(isset($_GET['message'])){
		                ?>
		                <div class="alert alert-danger">
		                    <span class="glyphicon glyphicon-remove"></span><strong> <?php echo $_GET['message'];?></strong>
		                </div>
		                <?php }else{ ?>
	                        <br>
	                    <?php }?>
		            </div>

                    <form role="form"  class="form-horizontal" method="post" action="action/doUpdateProduct.php" id="editProductForm" enctype="multipart/form-data">
                    	<input type="hidden" name="hfProductID" id="hfProductID" value="<?php echo $ProductID;?>" />
	                    <input type="hidden" name="hfOldPhoto" id="hfOldPhoto" value="<?php echo $row['Image'];?>" />
		                    
                    	<div class="form-group">
                        	<div class="col-md-4 col-md-offset-4">
	                        	<div class="thumbnail" style="border:0" >
		                            <img align="center" class="img-responsive" src="<?php echo $row['Image']; ?>">
	                          	</div>
                          	</div>
                      	</div>

                    	<div class="form-group">
                    		<label class="col-md-3 col-md-offset-1" for="txtProductName">
		                    	Product Name <label class="text-danger">*</label> 
		                    </label>
		                    <div class="col-md-7">
		                        <input type="text" class="form-control" name="txtProductName" id="txtProductName" placeholder="Enter Product Name" value="<?php if(isset($_GET['productname'])){echo $_GET['productname'];}else{ echo $row['Name'];} ?>" >
		                    </div>
		                </div>

                        <div class="form-group">
		                    <label class="col-md-3 col-md-offset-1" for="ddlCategory">
		                    	Category<label class="text-danger">*</label> 
		                    </label>
		                    <div class="col-md-7">
		                        <select name="ddlCategory" id="ddlCategory" class="form-control">
		                        	<?php
		                        		include('action/connect.php');
		                        		$query = "SELECT * FROM msCategory"." ORDER BY CategoryName ASC";
		                        		$result = mysql_query($query);
		                        		
		                        		while($r = mysql_fetch_array($result))
		                        		{ ?>
		                        			<option value="<?php echo $r['CategoryID']?>"
		                        				<?php if(isset($_GET['category'])){ if($_GET['category'] == $r['CategoryID']){echo "selected";} }else if($row['CategoryID']==$r['CategoryID']){echo "selected";} ?>
		                        			>
		                        				<?php echo $r['CategoryName']?>
		                        			</option>
	                        		<?php } 
		                        	?>
		                        </select>
		                    </div>
		                </div>

		                <div class="form-group">
                          <label class="col-md-3 col-md-offset-1">
                            Product Image <label class="text-danger">*</label> 
                          </label>
                          <div class="col-md-7">
                            <input type="file" name="filePhoto" id="filePhoto">
                            <p class="help-block">
                              Allowed formats: jpeg, jpg, png
                            </p>
                          </div>
                        </div>

		                <div class="form-group">
		                    <label class="col-md-3 col-md-offset-1" for="txtStock">
		                    	Stock <label class="text-danger">*</label> 
		                    </label>
		                    <div class="col-md-7">
		                        <input type="text" class="form-control" name="txtStock" id="txtStock" placeholder="Enter Stock" value="<?php if(isset($_GET['stock'])){echo $_GET['stock'];}else{ echo $row['Stock'];} ?>" >
		                    </div>
		                </div>

		                <div class="form-group">
		                    <label class="col-md-3 col-md-offset-1" for="txtPrice">
		                    	Price <label class="text-danger">*</label> 
		                    </label>
		                    <div class="col-md-7">
		                        <input type="text" class="form-control" name="txtPrice" id="txtPrice" placeholder="Enter Price" value="<?php if(isset($_GET['price'])){echo $_GET['price'];}else{ echo $row['Price'];} ?>" >
		                    </div>
		                </div>

		                <div class="form-group">
		                    <label class="col-md-3 col-md-offset-1" for="txtDescription">
		                    	Description 
		                    </label>
		                    <div class="col-md-7">
		                        <textarea class="form-control" rows="5" id="txtDescription" name="txtDescription" form="editProductForm" style="resize:none";><?php if(isset($_GET['description'])){echo $_GET['description'];}else{ echo $row['Description'];} ?></textarea>
		                    </div>
		                </div>
		                
                        <br>
                        
                        <div class="row" align="center">
                            <p>
                                <button type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit">
                                    Update Product
                                </button>
                                <a href="product_update.php?ProductID=<?php echo $ProductID;?>" class="btn btn-primary">
                                	Reset Product
                            	</a>
                        	</p>
                        </div>
                        <div class="row" align="center">
                        	<p>
                                <a href="product_detail.php?ProductID=<?php echo $ProductID;?>" class="btn btn-primary">
                                	Back
                                </a>
                            </p>
                        </div>
                    </form>        
                </div><!--end of panel body-->
            </div><!--end of panel-->
        </div><!--end of col-->
    </div><!--end row-->
</div>

<?php
	include('footer.php');
?>