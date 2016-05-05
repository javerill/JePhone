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

	$_SESSION['page']='profile';
	include('header.php');
?>
	
<div class="container-fluid" id="content" >
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading" align="center">
                    <h3 class="panel-title" style="font-size:50px;">Edit Profile</h3>
                </div><!--end of heading-->
                
                <div class="panel-body" style="padding:30px;">
                	<div class="col-md-12">
                		<?php
                			if(isset($_GET['message']) && $_GET['message']==1)
                			{
                		?>
		                <div class="alert alert-success">
		                    <strong><span class="glyphicon glyphicon-ok"></span> Update Profile Success.</strong>
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

                    <form role="form"  class="form-horizontal" method="post" action="action/doEditProfile.php" id="registerform" enctype="multipart/form-data">
                    	
                    	<div class="form-group">
                        	<div class="col-md-4 col-md-offset-4">
	                        	<div class="thumbnail" style="border:0" >
		                            <img align="center" class="img-responsive" src="<?php echo $_SESSION['UserLogin']['Image']; ?>">
	                          	</div>
                          	</div>
                      	</div>

                    	<div class="form-group">
		                    <label class="col-md-3 col-md-offset-1" for="txtUsername">
		                    	Username
		                    </label>
		                    <div class="col-md-7">
		                        <input type="text" class="form-control" name="txtUsername" id="txtUsername" value="<?php echo $_SESSION['UserLogin']['Username']; ?>" disabled >
		                    </div>
		                </div>

		                <div class="form-group">
		                    <label class="col-md-3 col-md-offset-1" for="txtFullname">
		                    	Fullname
		                    </label>
		                    <div class="col-md-7">
		                        <input type="text" class="form-control" name="txtFullname" id="txtFullname" placeholder="Enter Full Name" value="<?php if(isset($_GET['fullname'])){echo $_GET['fullname'];}else{ echo $_SESSION['UserLogin']['Fullname'];} ?>" >
		                    </div>
		                </div>

		                <div class="form-group">
		                    <label class="col-md-3 col-md-offset-1">
		                    	Gender 
		                    </label>
		                    <div class="col-md-7">
		                        <label class="radio-inline">
                                    <input type="radio" name="gender" value="male" <?php if(isset($_GET['gender'])){ if($_GET['gender'] == 'male'){echo "checked='true'";} }else if($_SESSION['UserLogin']['Gender']=='male'){echo "checked='true'";}?> > Male
                            	</label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="female" <?php if(isset($_GET['gender'])){ if($_GET['gender'] == 'female'){echo "checked='true'";} }else if($_SESSION['UserLogin']['Gender']=='female'){echo "checked='true'";}?> > Female
                      			</label>
		                    </div>
		                </div>

		                <div class="form-group">
		                    <label class="col-md-3 col-md-offset-1" for="txtEmail">
		                    	Email  
		                    </label>
		                    <div class="col-md-7">
		                        <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder="Enter Email Address" value="<?php if(isset($_GET['email'])){echo $_GET['email'];}else{echo $_SESSION['UserLogin']['Email'];} ?>" >
		                    </div>
		                </div>

		                <div class="form-group">
		                    <label class="col-md-3 col-md-offset-1" for="txtPhone">
		                    	Phone 
		                    </label>
		                    <div class="col-md-7">
		                        <input type="text" class="form-control" name="txtPhone" id="txtPhone" placeholder="Enter Phone Number" value="<?php if(isset($_GET['phone'])){echo $_GET['phone'];}else{echo $_SESSION['UserLogin']['Phone'];} ?>" >
		                    </div>
		                </div>

		                <div class="form-group">
		                    <label class="col-md-3 col-md-offset-1" for="txtAddress">
		                    	Address 
		                    </label>
		                    <div class="col-md-7">
		                        <textarea class="form-control" rows="5" id="txtAddress" name="txtAddress" form="registerform" style="resize:none";><?php if(isset($_GET['address'])){echo $_GET['address'];}else{echo $_SESSION['UserLogin']['Address'];} ?></textarea>
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

                        <div class="form-group">
		                    <label class="col-md-3 col-md-offset-1" for="txtAddress">
		                    	Delete Profile Picture 
		                    </label>
		                    <div class="col-md-7">
		                        <label>
                              		<input type="checkbox" name="cbxDeletePhoto" id="cbxDeletePhoto" value="Yes" > Yes
                              	</label>
		                    </div>
		                </div>

                        <br>
                        
                        <div align="center">
                            <button type="submit" class="btn btn-primary" id="btnSave" name="btnSave">
                                Save Changes
                            </button>
                            <a href="member_detail.php" class="btn btn-primary">
                            	Reset Profile
                            </a>
                        </div>
                    </form>        
                </div>
            </div>
        </div>
    </div>
</div>

<?php
	include('footer.php');
?>