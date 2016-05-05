<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	
	if(!isset($_SESSION['UserLogin']) || $_SESSION['UserLogin']['Role']!='admin')
	{
		header('location:../index.php');return;
	}

	include('connect.php');
	$filename = "TransactionReport.xls";
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");;
	header("Content-Disposition: attachment;filename=$filename");
	header("Content-Transfer-Encoding: binary");
?>

<table border="0">
<tr>

</tr>
<tr>
	<td>
	</td>
	<td>
		<h3><strong>Transaction Report</strong></h3>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<table border="1">
			<tr style="background-color:#337ab7;color:white">
				<th style="vertical-align:middle;text-align:center;">
					<h4><strong>No. </strong></h4>
				</th>
				<th style="vertical-align:middle; text-align: center;">
					<h4><strong>Transaction Date</strong></h4>
				</th>
				<th style="vertical-align:middle; text-align: center;">
					<h4><strong>Username</strong></h4>
				</th>
			</tr>
			<?php
				include('connect.php');

				$grandGrandTotal = 0;

				$query = "SELECT SalesID, a.MemberID, Username , DATE_FORMAT( SalesDate,  '%e %M %Y' ) AS NewSalesDate FROM trSalesheader a 
					JOIN msMember b ON a.MemberID = b.MemberID  ORDER BY SalesID ASC";
				$result=mysql_query($query);
				$i=1;

				while($r = mysql_fetch_array($result))
				{ ?>
					<tr>
						<td rowspan="2" style="vertical-align:middle; text-align:center;">
							<h4><strong><?php echo $i;?></strong></h4>

						</td>
						<td style="vertical-align:middle; text-align:center;">
							<h4><strong><?php echo$r['NewSalesDate']?></strong></h4>
							
						</td>
						<td style="vertical-align:middle; text-align:center;">
							<h4><strong><?php echo $r['Username'];?></strong></h4>
							
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<table border="1" style="margin:0px;">
								<tr style="background-color:#337ab7;color:white">
									<th colspan="5" style="vertical-align:middle;text-align:center;">
										Detail Transaction
									</th>
								</tr>
								<tr style="background-color:#337ab7;color:white">
									<th style="vertical-align:middle;text-align:center;width:20px;">
										#
									</th>
									<th style="vertical-align:middle;text-align:center;">
										Product Name
									</th><th style="vertical-align:middle;text-align:center;">
										Price
									</th>
									<th style="vertical-align:middle;text-align:center;">
										Quantity
									</th>
									<th style="vertical-align:middle;text-align:center;">
										Total Price
									</th>
								</tr>
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
										<td style="vertical-align:middle;text-align:center;">
											<?php echo $r2['Name'];?>
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
									<td colspan="4" style="vertical-align:middle;text-align:center;">
										<h4><strong>Grand Total</strong></h4>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<h4><strong>Rp. <?php echo number_format($grandTotal,2,",",".");?></strong></h4>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr style="background-color:black;">
						<td colspan="3">
						</td>
					</tr>
				<?php
					$i++;
					$grandGrandTotal=$grandGrandTotal+$grandTotal;
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
		</table>
	</td>
</tr>


  