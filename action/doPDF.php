<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	if(!isset($_SESSION['UserLogin']) || $_SESSION['UserLogin']['Role']!='admin')
	{
		header('location:../index.php');return;
	}

	include('html2pdf/html2pdf.class.php');
	include('connect.php');
	
	$pdf = new HTML2PDF();
	
	$grandGrandTotal = 0;

	$str = '
	<h3> Transaction Report </h3>
	<table border="1">
			<tr style="background-color:#337ab7;color:white">
				<th style="vertical-align:middle; text-align:center;">
					<h4><strong> No. </strong></h4>
				</th>
				<th style="vertical-align:middle; text-align: center;">
					<h4><strong>Transaction Date</strong></h4>
				</th>
				<th style="vertical-align:middle; text-align: center;">
					<h4><strong>Username</strong></h4>
				</th>
			</tr>';
			

	$query = "SELECT SalesID, a.MemberID, Username , DATE_FORMAT( SalesDate,  '%e %M %Y' ) AS NewSalesDate FROM trSalesheader a 
		JOIN msMember b ON a.MemberID = b.MemberID  ORDER BY SalesID ASC";
	$result=mysql_query($query);
	$i=1;

	while($r = mysql_fetch_array($result))
	{ 
		$str.='<tr>
					<td rowspan="2" style="vertical-align:middle; text-align:center;">
						<h4><strong>'.$i.'</strong></h4>

					</td>
					<td style="vertical-align:middle; text-align: center;">
						<h4><strong>'.$r["NewSalesDate"].'</strong></h4>
					</td>
					<td style="vertical-align:middle; text-align: center;">
						<h4><strong>'.$r["Username"].'</strong></h4>
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
								</tr>';
								

								$grandTotal=0;

								$query2 = "SELECT a.ProductID,b.Name,b.Image,b.Price, a.Quantity FROM trSalesdetail a
									JOIN msProduct b ON a.ProductID = b.ProductID  WHERE a.SalesID =".$r['SalesID'];
								$result2=mysql_query($query2);
								$j=1;
								while($r2 = mysql_fetch_array($result2))
								{ 
									$total=$r2['Price']*$r2['Quantity'];
									$grandTotal = $grandTotal + $total;
									
								$str.='<tr>
										<td style="vertical-align:middle;text-align:center;">
											'.$j.'
										</td>
										<td style="vertical-align:middle;text-align:center;">
											'.$r2["Name"].'
										</td>
										<td style="vertical-align:middle;text-align:center;">
											Rp. '.number_format($r2['Price'],2,",",".").'
										</td>
										<td style="vertical-align:middle;text-align:center;">
											'.$r2["Quantity"].'
										</td>
										<td style="vertical-align:middle;text-align:center;">
											Rp. '.number_format($total,2,",",".").'
										</td>
									</tr>';

										$j++;
									}
								$str.='<tr>
									<td colspan="4" style="vertical-align:middle;text-align:center;">
										<h4><strong>Grand Total</strong></h4>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<h4><strong>Rp. '.number_format($grandTotal,2,",",".").'</strong></h4>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr style="background-color:black;">
						<td colspan="3">
						</td>
					</tr>';
				$i++;
				$grandGrandTotal = $grandGrandTotal+$grandTotal;
			}

		$str.='<tr>
				<td align="center" colspan="2">
					<h3><strong>Grand Total</strong></h3>
				</td>
				<td align="center" >
					<h3><strong>Rp. '.number_format($grandGrandTotal,2,",",".").'</strong></h3>
				</td>
			</tr>
			</table>';


	$pdf->WriteHTML($str);
	$pdf->Output('TransactionReport.pdf');
	
?>