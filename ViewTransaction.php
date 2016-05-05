<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_SESSION['UserLogin']) || $_SESSION['UserLogin']['Role']!='admin')
	{
		header('location:index.php');
		return;
	}

	$_SESSION['page']='viewTransaction';
	include('header.php');
?>
	
	<div class="container-fluid" id="content" >
		<div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading" align="center">
                        <h3 class="panel-title" style="font-size:50px;">Transaction History</h3>
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
							<form class="form-inline">
								<div class="form-group">
		    						<label for="txtSearch">Export to :</label>
									<a href="action/doExcel.php" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span> Excel</a>
									<a href="action/doPDF.php" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span> PDF</a>
								</div>
							</form>
			            </div>
			            <div class="col-md-12 table-responsive">
							<table class="table table-striped table-condensed table-hover table-bordered panel-primary">
								<thead class="panel-heading">
									<tr>
										<th style="vertical-align:middle;text-align:center;">
											<h4><strong>No.</strong></h4>
										</th>
										<th style="vertical-align:middle;text-align:center;">
											<h4><strong>Transaction Date</strong></h4>
										</th>
										<th style="vertical-align:middle;text-align:center;">
											<h4><strong>Username</strong></h4>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										include('action/connect.php');

										$query = "SELECT SalesID, a.MemberID, Username , DATE_FORMAT( SalesDate,  '%e %M %Y' ) AS NewSalesDate FROM trSalesheader a 
											JOIN msMember b ON a.MemberID = b.MemberID ORDER BY SalesID ASC";
										$result=mysql_query($query);
										$i=1;
										$grandGrandTotal = 0;

										while($r = mysql_fetch_array($result))
										{ ?>
											<tr>
												<td rowspan="2" style="vertical-align:middle;text-align:center;">
													<h4><strong><?php echo $i;?></strong></h4>

												</td>
												<td style="vertical-align:middle;text-align:center;">
													<h4><strong><?php echo$r['NewSalesDate']?></strong></h4>
													
												</td>
												<td style="vertical-align:middle;text-align:center;">
													<h4><strong><?php echo $r['Username'];?></strong></h4>
													
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<table class="table table-striped table-condensed table-hover table-bordered panel-primary" style="margin:0px;">
														<thead class="panel-heading">
															<tr>
																<th colspan="6" style="vertical-align:middle;text-align:center;">
																	Detail Transaction
																</th>
															</tr>
															<tr>
																<th style="vertical-align:middle;text-align:center;">
																	#
																</th>
																<th style="vertical-align:middle;text-align:center;">
																	Image
																</th>
																<th style="vertical-align:middle;text-align:center;">
																	Product Name
																</th><th style="vertical-align:middle;text-align:center;">
																	Price
																</th>
																<th style="vertical-align:middle;text-align:center;">
																	Qty
																</th>
																<th style="vertical-align:middle;text-align:center;">
																	Total Price
																</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$grandTotal=0;

															$query2 = "SELECT a.ProductID,b.Name,b.Image,b.Price, a.Quantity FROM trSalesdetail a
																JOIN msProduct b ON a.ProductID = b.ProductID  WHERE a.SalesID =".$r['SalesID'];
															$result2=mysql_query($query2);
															$j=1;
															while($r2 = mysql_fetch_array($result2))
															{ 
																$total=$r2['Price']*$r2['Quantity'];
																$grandTotal = $grandTotal + $total;
																?>
																<tr>
																	<td style="vertical-align:middle;text-align:center;">
																		<?php echo $j;?>
																	</td>
																	<td style="vertical-align:middle;text-align:center;" >
																		<a href="product_detail.php?ProductID=<?php echo $r2['ProductID'];?>">
																			<img width="75" height="75" src="<?php echo $r2['Image'];?>">
																		</a>
																	</td>
																	<td style="vertical-align:middle;text-align:center;">
																		<a href="product_detail.php?ProductID=<?php echo $r2['ProductID'];?>">
																			<?php echo $r2['Name'];?>
																		</a>
																	</td>
																	<td style="vertical-align:middle;text-align:center;">
																		Rp. <?php echo number_format($r2['Price'],2,",",".");?>
																	</td>
																	<td style="vertical-align:middle;text-align:center;">
																		<?php echo $r2['Quantity'];?>
																	</td>
																	<td style="vertical-align:middle;text-align:center;">
																		Rp. <?php echo number_format($total,2,",",".");?>
																	</td>
																</tr>
															<?php
																$j++;
															}?>
															<tr>
																<td colspan="5" style="vertical-align:middle;text-align:center;">
																	<h4><strong>Grand Total</strong></h4>
																</td>
																<td style="vertical-align:middle;text-align:center;">
																	<h4><strong>Rp. <?php echo number_format($grandTotal,2,",",".");?></strong></h4>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr style="background-color:black;">
												<td colspan="3">
												</td>
											</tr>
										<?php
											$grandGrandTotal = $grandGrandTotal+$grandTotal;
											$i++;
										}
									?>
									<tr>
										<td align="center" colspan="2">
											<h3><strong>Grand Total</strong></h3>
										</td>
										<td align="center" >
											<h3><strong>Rp. <?php echo number_format($grandGrandTotal,2,",",".");?></strong></h3>
										</td>
									</tr>
								</tbody>
					        </table>
					    </div>
                    </div><!--end of panel body-->
                </div><!--end of panel-->
            </div><!--end of col-->
        </div><!--end row-->
	</div>

<?php
	include('footer.php');

?>