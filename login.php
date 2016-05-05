<?php
	if(!isset($_SESSION))
    {
        session_start();
    }

	if(isset($_SESSION['UserLogin']))
	{
		header('location:index.php');return;
	}

	$_SESSION['page']='login';
	include('header.php');
?>
	
<div class="container-fluid" id="content">
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading" align="center">
                    <h3 class="panel-title" style="font-size:50px;">Login Form</h3>
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
		                <?php }?>
		            </div>

                    <br>

                    <form role="form"  class="form-horizontal" method="post" action="action/doLogin.php" id="loginform">
                    	<div class="form-group">
		                    <label class="col-md-3 col-md-offset-1" for="txtUsername">
		                    	Username <label class="text-danger">*</label> 
		                    </label>
		                    <div class="col-md-7">
		                        <input type="text" class="form-control" name="txtUsername" id="txtUsername" placeholder="Enter Username" autocomplete="off" value="<?php if(isset($_COOKIE['Username'])) { echo $_COOKIE['Username']; } ?>" >
		                    </div>
		                </div>

                        <br>

                        <div class="form-group">
		                    <label class="col-md-3 col-md-offset-1" for="txtPassword">
		                    	Password <label class="text-danger">*</label> 
		                    </label>
		                    <div class="col-md-7">
		                        <input type="password" class="form-control" name="txtPassword" id="txtPassword" placeholder="Enter Password" autocomplete="off" value="<?php if(isset($_COOKIE['Password'])) { echo $_COOKIE['Password']; } ?>" >
		                    </div>
		                </div>

                        <div class="checkbox">
                          <div align="center">
                            <label>
                              <input type="checkbox" name="cbxRemember" id="cbxRemember" value="Yes" <?php if(isset($_COOKIE['Username'])) {echo 'checked="true"';} ?> >Remember me</label>
                          </div>
                        </div>

                        <br>
                        
                        <div align="center">
                            <button type="submit" class="btn btn-primary" id="btnRegister" name="btnRegister">
                                Login
                            </button>
                        </div>
                        
                        <br>

                        <div align="center">
                            <label>
                            	Don't have an account? <a href="register.php">Register Here!</a>
                            </label>
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