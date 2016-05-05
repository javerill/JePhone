<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	$_SESSION['page']='aboutus';
	include('header.php');
?>
	
<div class="container-fluid" id="content" >
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading" align="center">
                    <h3 class="panel-title" style="font-size:50px;">About Us</h3>
                </div>
                
                <div class="panel-body" style="padding-top:30px;padding-bottom:30px;padding-left:50px;padding-right:50px;">
                	<div class="form-group">
                    	<div class="col-md-4 col-md-offset-4">
                        	<div class="thumbnail">
	                            <img align="center" class="img-responsive" src="asset/img/logo.png">
	                            <div class="caption">
		                          	<h2 class="text-primary text-center">
		                    			<strong>JePhone</strong>
		                    		</h2>
	                    		</div>
                          	</div>
                      	</div>
                  	</div>
                	<div class="col-md-12">
                		<br>
                		<h3 class="text-primary">
                			<strong>WHAT DO WE DO?</strong>
                		</h3>
                		<p class="text-justify">
							<strong>JePhone</strong> gives you a chance to quickly and easily find the phone you want and have it delivered to your home in no time, regardless of your location, as long as it is in one of the countries of the INDONESIA.
						</p>
						<h3 class="text-primary">
                			<strong>WHY DO CUSTOMERS LOVE US?</strong>
                		</h3>
                		<p class="text-justify">
							We have been in the business for quite a while now, and it that time we have not only managed to make close relationships with numerous suppliers all over the world, but also to recognize what people need. This means that we are always able to offer all the latest phones, great prices, reliable service, fast delivery and premium customer support.
						</p>

						<h3 class="text-primary text-center">
                			<strong>The Story</strong>
                		</h3>

                		<h3 class="text-primary">
                			<strong>BEGINNING</strong>
                		</h3>
						<p class="text-justify">
							<strong>JePhone</strong> website was launched in 2016, but its story actually began some 2 years before that when a group of college friends decided to go into business together. We started selling phones in shops, but our combined ambition, drive and abilities soon made us look for new challenges and new markets. Starting an online shop provided for both and allowed us to develop a strong international presence in a number of INDONESIA countries.
						</p>

						<h3 class="text-primary">
                			<strong>TODAY</strong>
                		</h3>
						<p class="text-justify">
							Collective experience of our team members and the years we have spent in the business allowed us to develop a vast network of suppliers, ensuring that our customers will always find what they are looking for. This also means that we are able to offer great prices, which are constantly being updated and follow the shifts in the market.
						</p>

						<p class="text-justify">
							Our affordability, fast and reliable delivery, and the fact that you will always be able to find the phone that you are looking for in our offer, have made us stand out in the market, but they are simply symptoms of our dedication to what we are doing and our desire to constantly keep improving. We know that in order to do that, we need to keep in close touch with our customers and listen to their suggestions and critiques. This is why our customer service, which is always there to answer any question that you may have, is just as willing to listen as it is to inform.
						</p>
		            </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
	include('footer.php');
?>