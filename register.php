<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(isset($_SESSION['UserLogin']))
	{
		header('location:index.php');return;
	}

	$_SESSION['page']='register';
	include('header.php');
?>
	
	<div class="container-fluid" id="content" >
		<div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading" align="center">
                        <h3 class="panel-title" style="font-size:50px;">Registration Form</h3>
                    </div><!--end of heading-->
                    
                    <div class="panel-body" style="padding:30px;">
                    	<div class="col-md-12">
                    		<?php
                    			if(isset($_GET['message']) && $_GET['message']==1)
                    			{
                    		?>
                    		
			                <div class="alert alert-success">
			                    <strong><span class="glyphicon glyphicon-ok"></span> Register Success, You can login now.</strong>
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

                        <form role="form"  class="form-horizontal" method="post" action="action/doregister.php" id="registerform" enctype="multipart/form-data">
                        	<div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtUsername">
			                    	Username <label class="text-danger">*</label> 
			                    </label>
			                    <div class="col-md-7">
			                        <input type="text" class="form-control" name="txtUsername" id="txtUsername" placeholder="Enter Username" value="<?php if(isset($_GET['username'])){echo $_GET['username'];}?>" >
			                    </div>
			                </div>

                            <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtPassword">
			                    	Password <label class="text-danger">*</label> 
			                    </label>
			                    <div class="col-md-7">
			                        <input type="password" class="form-control" name="txtPassword" id="txtPassword" placeholder="Enter Password" >
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtConfirmPassword">
			                    	Confirm Password <label class="text-danger">*</label> 
			                    </label>
			                    <div class="col-md-7">
			                        <input type="password" class="form-control" name="txtConfirmPassword" id="txtConfirmPassword" placeholder="Enter Confirm Password" >
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtFullname">
			                    	Fullname <label class="text-danger">*</label> 
			                    </label>
			                    <div class="col-md-7">
			                        <input type="text" class="form-control" name="txtFullname" id="txtFullname" placeholder="Enter Full Name" value="<?php if(isset($_GET['fullname'])){echo $_GET['fullname'];}?>" >
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1">
			                    	Gender <label class="text-danger">*</label> 
			                    </label>
			                    <div class="col-md-7">
			                        <label class="radio-inline">
	                                    <input type="radio" name="gender" value="male" <?php if(isset($_GET['gender']) && $_GET['gender']=='male'){echo "checked='true'";}?>  > Male
                                	</label>
	                                <label class="radio-inline">
	                                    <input type="radio" name="gender" value="female" <?php if(isset($_GET['gender']) && $_GET['gender']=='female'){echo "checked='true'";}?> > Female
                          			</label>
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtEmail">
			                    	Email <label class="text-danger">*</label> 
			                    </label>
			                    <div class="col-md-7">
			                        <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder="Enter Email Address" value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>" >
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtPhone">
			                    	Phone <label class="text-danger">*</label> 
			                    </label>
			                    <div class="col-md-7">
			                        <input type="text" class="form-control" name="txtPhone" id="txtPhone" placeholder="Enter Phone Number" value="<?php if(isset($_GET['phone'])){echo $_GET['phone'];}?>" >
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtAddress">
			                    	Address <label class="text-danger">*</label> 
			                    </label>
			                    <div class="col-md-7">
			                        <textarea class="form-control" rows="5" id="txtAddress" name="txtAddress" form="registerform" style="resize:none";><?php if(isset($_GET['address'])){echo $_GET['address'];}?></textarea>
			                    </div>
			                </div>

			                <div class="form-group">
                              <label class="col-md-3 col-md-offset-1">
                                Profile Picture
                              </label>
                              <div class="col-md-7">
                                <input type="file" name="filePhoto" id="filePhoto">
                                <p class="help-block">
                                  Allowed formats: jpeg, jpg, png, gif
                                </p>
                              </div>
                            </div>

                            <div class="checkbox">
                              <div align="center">
                                <label>
                                  <input type="checkbox" name="cbxConfirmation" id="cbxConfirmation" value="Yes" >Agree with Terms and Conditions</label>
                              </div>
                            </div>

                            <br>
                            
                            <div align="center">
                                <button type="submit" class="btn btn-primary" id="btnRegister" name="btnRegister">
                                    Submit
                                </button>
                                <a href="register.php" class="btn btn-primary">
                                	Reset Form
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