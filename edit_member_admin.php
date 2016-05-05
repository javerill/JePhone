<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_SESSION['UserLogin']) || $_SESSION['UserLogin']['Role']!='admin' || !isset($_GET['MemberID']))
	{
		header('location:index.php');
		return;
	}

	$MemberID = $_GET['MemberID'];

	include('action/connect.php');

	$query="SELECT * FROM msMember WHERE MemberID = $MemberID";
	$result=mysql_query($query);
	$num_row= mysql_num_rows($result);

	if($num_row==0)
	{
		header('location:index.php');
		return;
	}else
	{
		$row = mysql_fetch_assoc($result);
	}

	$_SESSION['page']='member';
	include('header.php');
?>
	
	<div class="container-fluid" id="content" >
		<div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading" align="center">
                        <h3 class="panel-title" style="font-size:50px;">Edit Member</h3>
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

                        <form role="form"  class="form-horizontal" method="post" action="action/doSaveEditMember_Admin.php" id="registerform" enctype="multipart/form-data">
                        	
                        	<div class="form-group">
	                        	<div class="col-md-4 col-md-offset-4">
		                        	<div class="thumbnail" style="border:0" >
			                            <img align="center" class="img-responsive" src="<?php echo $row['Image']; ?>">
		                          	</div>
	                          	</div>
                          	</div>

                        	<div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtUsername">
			                    	Username
			                    </label>
			                    <div class="col-md-7">
			                        <input type="text" class="form-control" name="txtUsername" id="txtUsername" value="<?php echo $row['Username']; ?>" disabled >
			                        <input type="hidden" name="hfMemberID" id="hfMemberID" value="<?php echo $MemberID;?>" />
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtFullname">
			                    	Fullname
			                    </label>
			                    <div class="col-md-7">
			                        <input type="text" class="form-control" name="txtFullname" id="txtFullname" placeholder="Enter Full Name" value="<?php if(isset($_GET['fullname'])){echo $_GET['fullname'];}else{ echo $row['Fullname'];} ?>" >
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1">
			                    	Gender 
			                    </label>
			                    <div class="col-md-7">
			                        <label class="radio-inline">
	                                    <input type="radio" name="gender" value="male" <?php if(isset($_GET['gender'])){ if($_GET['gender'] == 'male'){echo "checked='true'";} }else if($row['Gender']=='male'){echo "checked='true'";}?> > Male
                                	</label>
	                                <label class="radio-inline">
	                                    <input type="radio" name="gender" value="female" <?php if(isset($_GET['gender'])){ if($_GET['gender'] == 'female'){echo "checked='true'";} }else if($row['Gender']=='female'){echo "checked='true'";}?> > Female
                          			</label>
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtEmail">
			                    	Email  
			                    </label>
			                    <div class="col-md-7">
			                        <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder="Enter Email Address" value="<?php if(isset($_GET['email'])){echo $_GET['email'];}else{echo $row['Email'];} ?>" >
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtPhone">
			                    	Phone 
			                    </label>
			                    <div class="col-md-7">
			                        <input type="text" class="form-control" name="txtPhone" id="txtPhone" placeholder="Enter Phone Number" value="<?php if(isset($_GET['phone'])){echo $_GET['phone'];}else{echo $row['Phone'];} ?>" >
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtAddress">
			                    	Address 
			                    </label>
			                    <div class="col-md-7">
			                        <textarea class="form-control" rows="5" id="txtAddress" name="txtAddress" form="registerform" style="resize:none";><?php if(isset($_GET['address'])){echo $_GET['address'];}else{echo $row['Address'];} ?></textarea>
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtPhone">
			                    	Status 
			                    </label>
			                    <div class="col-md-7">
			                        <select name="ddlStatus" id="ddlStatus" class="form-control">
			                        	<option value="none" <?php if(isset($_GET['status'])){ if($_GET['status'] == 'none'){echo "selected";} }else if($row['Status']=='none'){echo "selected";}?> >
			                        		Unban
			                        	</option>
			                        	<option value="banned" <?php if(isset($_GET['status'])){ if($_GET['status'] == 'banned'){echo "selected";} }else if($row['Status']=='banned'){echo "selected";}?> >
			                        		Ban
			                        	</option> 
			                        </select>
			                    </div>
			                </div>

			                <div class="form-group">
			                    <label class="col-md-3 col-md-offset-1" for="txtPhone">
			                    	Role 
			                    </label>
			                    <div class="col-md-7">
			                        <select name="ddlRole" id="ddlRole" class="form-control">
			                        	<option value="admin" <?php if(isset($_GET['role'])){ if($_GET['role'] == 'admin'){echo "selected";} }else if($row['Role']=='admin'){echo "selected";}?> >
			                        		Admin
			                        	</option>
			                        	<option value="member" <?php if(isset($_GET['role'])){ if($_GET['role'] == 'member'){echo "selected";} }else if($row['Role']=='member'){echo "selected";}?> >
			                        		Member
			                        	</option> 
			                        </select>
			                    </div>
			                </div>

			                <div class="form-group">
			                	<input type="hidden" name="hfPhoto" id="hfPhoto" value="<?php echo $row['Image']?>" />
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
                            
                            <div class="row" align="center">
                                <p>
	                                <button type="submit" class="btn btn-primary" id="btnSave" name="btnSave">
	                                    Update Profile
	                                </button>
	                                <a href="edit_member_admin.php?MemberID=<?php echo $MemberID?>" class="btn btn-primary">
	                                	Reset Profile
	                                </a>
                                </p>
                            </div>
                            <div class="row" align="center">
                            	<p>
	                                <a href="member_list.php" class="btn btn-primary">
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