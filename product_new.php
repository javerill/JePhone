<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_SESSION['UserLogin']) || $_SESSION['UserLogin']['Role']!='admin')
	{
		header('location:index.php');return;
	}

	$_SESSION['page']='newProduct';
	include('header.php');
?>
	
	<div class="container-fluid" id="content" >
		<div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading" align="center">
                        <h3 class="panel-title" style="font-size:50px;">Add Product</h3>
                    </div><!--end of heading-->
                    
                    <div class="panel-body" style="padding:30px;">
                    	<div class="col-md-12">
                    		<?php
                    			if(isset($_GET['message']) && $_GET['message']==1)
                    			{
                    		?>
			                <div class="alert alert-success">
			                    <strong><span class="glyphicon glyphicon-ok"></span> Add Product Success.</strong>
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

                        <form role="form"  class="form-horizontal" method="post" action="action/doAddProduct.php" id="addProductForm" enctype="multipart/form-data">
                        	<div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtProductName">
			                    	Product Name <label class="text-danger">*</label> 
			                    </label>
			                    <div class="col-md-7">
			                        <input type="text" class="form-control" name="txtProductName" id="txtProductName" placeholder="Enter Product Name" value="<?php if(isset($_GET['productname'])){echo $_GET['productname'];}?>" >
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
			                        			<option value="<?php echo $r['CategoryID']?>" <?php if(isset($_GET['category']) && $_GET['category']==$r['CategoryID']){echo 'selected';} ?> >
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
			                        <input type="text" class="form-control" name="txtStock" id="txtStock" placeholder="Enter Stock" value="<?php if(isset($_GET['stock'])){echo $_GET['stock'];}?>" >
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtPrice">
			                    	Price <label class="text-danger">*</label> 
			                    </label>
			                    <div class="col-md-7">
			                        <input type="text" class="form-control" name="txtPrice" id="txtPrice" placeholder="Enter Price" value="<?php if(isset($_GET['price'])){echo $_GET['price'];}?>" >
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtDescription">
			                    	Description 
			                    </label>
			                    <div class="col-md-7">
			                        <textarea class="form-control" rows="5" id="txtDescription" name="txtDescription" form="addProductForm" style="resize:none";><?php if(isset($_GET['description'])){echo $_GET['description'];}?></textarea>
			                    </div>
			                </div>
			                
                            <br>
                            
                            <div align="center">
                                <button type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit">
                                    Submit
                                </button>
                                <a href="product_new.php" class="btn btn-primary">
                                	Reset
                            	</a>
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