<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_SESSION['UserLogin']) || $_SESSION['UserLogin']['Role']!='admin')
	{
		header('location:index.php');return;
	}

	$_SESSION['page']='member';
	include('header.php');
?>
	
	<div class="container-fluid" id="content">
		<div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading" align="center">
                        <h3 class="panel-title" style="font-size:50px;">List of Member</h3>
                    </div><!--end of heading-->
                    
                    <div class="panel-body" style="padding:30px;">
                    	<div class="col-md-12">
                    		<?php
                    			if(isset($_GET['message']))
                    			{
                    		?>
			                <div class="alert alert-success">
			                    <strong><span class="glyphicon glyphicon-ok"></span> <?php echo $_GET['message'];?>.</strong>
			                </div>
			                <?php }else{ ?>
    	                        <br>
    	                    <?php }?>
			            </div>
			            <div class="col-md-12">
							<form method="get" action="member_list.php" class="form-inline">
								<div class="form-group">
		    						<label for="txtSearch">Search :</label>
									<input type="text" class="form-control" id="txtSearch" name="txtSearch" placeholder="Enter Member Name" value="<?php if(isset($_GET['txtSearch']))echo $_GET['txtSearch'];?>">
								</div>
								<button type="submit" class="btn btn-primary">Search</button>
							</form>
			            </div>
			            <div class="col-md-12 table-responsive">
							<table class="table table-striped table-condensed table-hover table-bordered panel-primary">
								<thead class="panel-heading">
									<tr>
										<th style="vertical-align:middle;text-align:center;">
											<h4 style="text-align:center"><strong>No.</strong></h4>
										</th>
										<th style="vertical-align:middle;text-align:center;">
											<h4 style="text-align:center"><strong>Photo</strong></h4>
										</th>
										<th style="vertical-align:middle;text-align:center;">
											<h4 style="text-align:center"><strong>Username</strong></h4>
										</th>
										<th style="vertical-align:middle;text-align:center;">
											<h4 style="text-align:center"><strong>Full Name</strong></h4>
										</th>
										<th style="vertical-align:middle;text-align:center;">
											<h4 style="text-align:center"><strong>Address</strong></h4>
										</th>
										<th style="vertical-align:middle;text-align:center;">
											<h4 style="text-align:center"><strong>Gender</strong></h4>
										</th>
										<th style="vertical-align:middle;text-align:center;">
											<h4 style="text-align:center"><strong>Email</strong></h4>
										</th>
										<th style="vertical-align:middle;text-align:center;">
											<h4 style="text-align:center"><strong>Phone</strong></h4>
										</th>
										<th style="vertical-align:middle;text-align:center;">
											<h4 style="text-align:center"><strong>Role</strong></h4>
										</th>
										<th style="vertical-align:middle;text-align:center;">
											<h4 style="text-align:center"><strong>Status</strong></h4>
										</th>
										<th style="vertical-align:middle; text-align:center;">
											<h4 style="text-align:center"><strong>Action</strong></h4>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										include('action/connect.php');

										$page=1;
										
										$search = "";
										
										if(isset($_GET['txtSearch']))
											$search = $_GET['txtSearch'];

										$query="SELECT * FROM msMember WHERE fullname like '%$search%'";
										$result=mysql_query($query);
										$jumlahData= mysql_num_rows($result);
										$jumlahDataPerPage = 10;
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

										$query = "SELECT * FROM msMember WHERE fullname like '%$search%' LIMIT ".(($page*$jumlahDataPerPage)-$jumlahDataPerPage).",$jumlahDataPerPage";
										$result=mysql_query($query);
										$i=1;

										while($r = mysql_fetch_array($result))
										{ ?>
											<tr>
												<td style="vertical-align:middle;text-align:center;"><?php echo $i+(($page-1)*$jumlahDataPerPage);?></td>
												<td style="vertical-align:middle;text-align:center;"><img src="<?php echo $r['Image'];?>" width="50px" height="50px" /></td>
												<td style="vertical-align:middle;text-align:center;"><?php echo $r['Username'];?></td>
												<td style="vertical-align:middle;text-align:center;"><?php echo $r['Fullname'];?></td>
												<td style="vertical-align:middle;text-align:center;"><?php echo $r['Address'];?></td>
												<td style="vertical-align:middle;text-align:center;"><?php echo $r['Gender'];?></td>
												<td style="vertical-align:middle;text-align:center;"><?php echo $r['Email'];?></td>
												<td style="vertical-align:middle;text-align:center;"><?php echo $r['Phone'];?></td>
												<td style="vertical-align:middle;text-align:center;"><?php echo $r['Role'];?></td>
												<td style="vertical-align:middle;text-align:center;"><span class="<?php if($r['Status']=='banned'){echo'text-danger';} else{echo 'text-Success';} ?>"><?php echo $r['Status'];?></span></td>
												<td style="vertical-align:middle; text-align:center;width:50px;" >
													<a href="edit_member_admin.php?MemberID=<?php echo $r['MemberID'];?>" class="btn btn-primary" title="Edit" style="width: 100px;"><span class="glyphicon glyphicon-pencil"></span> Edit</a>

													<form style="display:inline" action="action/doDeleteMember.php?page=<?php echo $page;?>" method="post">
														<input type="hidden" name="hfMemberID" id="hfMemberID" value="<?php echo $r['MemberID'];?>" />
														<input type="hidden" name="hfPhoto" id="hfPhoto" value="<?php echo $r['Image']; ?>" />
														<button type="submit" class="btn btn-danger" title="Delete" style="width: 100px; margin-top: 5px;"><span class="glyphicon glyphicon-trash"></span> Delete</button>
													</form>


													<form style="display:inline" action="action/doBanOrUnbanMember.php?page=<?php echo $page;?>" method="post">
														<input type="hidden" name="hfMemberID" id="hfMemberID" value="<?php echo $r['MemberID'];?>" />
													<?php if($r['Status']=='none'){?>
														<input type="hidden" name="hfStatus" id="hfStatus" value="ban" />
														<button type="submit" class="btn btn-success" title="Unban" style="margin-top: 5px;"><span class="glyphicon glyphicon-ok-circle"></span> Unbanned</button>
													<?php }else{ ?>
														<input type="hidden" name="hfStatus" id="hfStatus" value="unban" />
														<button type="submit" class="btn btn-danger" title="Ban" style="margin-top: 5px;"><span class="glyphicon glyphicon-ban-circle" style="width: 20px;"></span> Banned</button>
													<?php } ?>
													</form>
												</td>
											</tr>
										<?php
											$i++;
										}
									?>
								</tbody>
					        </table>
					        <ul class="pagination pull-right">
								<?php
									if($page==1)
									{
										echo '<li class="disabled"><a>&laquo;</a></li>';
									}
									else
									{
										echo '<li> <a href="member_list.php?txtSearch='.$search.'&page='.($page-1).'">&laquo;</a></li>';
									}

									for($i = 1; $i<=$jumlahHalaman;$i++)
									{
										if($page==$i)
										{
											echo "<li class='active'><a>$i</a></li>";
										}
										else
										{
											echo "<li><a href='member_list.php?txtSearch=$search&page=$i'>$i</a></li>";
										}
									}

									if($page==$jumlahHalaman)
									{
										echo '<li class="disabled"><a>&raquo;</a></li>';
									}
									else
									{
										echo '<li> <a href="member_list.php?txtSearch='.$search.'&page='.($page+1).'">&raquo;</a></li>';
									}
								?>
		                  	</ul>
					    </div>
                    </div><!--end of panel body-->
                </div><!--end of panel-->
            </div><!--end of col-->
        </div><!--end row-->
	</div>

<?php
	include('footer.php');

?>