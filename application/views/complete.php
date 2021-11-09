 <style type="text/css">
 	#info {
    position: absolute;
    bottom: 48px;
    color: darkgray;
    font-size: 10px;
}
 </style>
 <br><br><br> 
<section id="team" >
    <div class="container"  >
       <div class="row">
			<div class="col-md-12 mt-5 text-center">
				<h3><b>Payment Redirect Page</b></h3>
			</div>
			<div class="col-md-4">
				
			</div>
			<div class="col-md-4 mt-5 text-center">
				<h3></h3>
				<br><br>
				
			</div>
			<div class="col-md-4"></div>
	   </div>
    </div>
</section>
<br><br><br><br>
  
<script type="text/javascript">
	alert(window.sessionStorage.getItem("partner_tx_id"));
	if(sessionStorage.getItem("partner_tx_id")){
		if(sessionStorage.getItem("partner_tx_id") != ''){
        	alert(sessionStorage.getItem("partner_tx_id"));
    	}
    }
	if(sessionStorage.getItem("partner_tx_id")){
		if(sessionStorage.getItem("partner_tx_id") != ''){
        	var trx = sessionStorage.getItem("partner_tx_id");
        	var settings = {
			  "url": "https://api-stg.oyindonesia.com/api/payment-checkout/status?partner_tx_id="+trx+"&send_callback=false",
			  "method": "GET",
			  "timeout": 0,
			  "headers": {
			    "x-oy-username": "pendanaid",
			    "x-api-key": "d4223670-1abb-491c-be03-c32370774324",
			    "content-type": "application/json"
			  },
			};

			$.ajax(settings).done(function (response) {
			  console.log(response);
			  // sessionStorage.setItem("partner_tx_id", "");
			  // data = {
		   //      amount:response.amount,
		   //      sender_name:response.sender_name,
		   //      status:response.status,
		   //      amount:response.amount
		   //    }
		   //    console.log(data);
			});
    	}
    }
</script>
  