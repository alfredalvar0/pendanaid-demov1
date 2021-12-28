<section id="content">
	<div class="container py-5">
		<div class="row">
			<div class="col-md-8 col-lg-6 mx-auto">
				<h1 class="mb-5 text-center" style="font-weight: 700; font-size: 28px;">Daftar Rekening Deposit</h1>
				<div class="card card-body">
					<p style="font-size: 20px; font-weight: 700;">Check Out Form</p>

					<form id="filtyer-form" method="post">
						<input type="hidden" value="<?php echo $this->session->userdata("invest_username"); ?>" id="name" class="form-control" required>
						<input type="hidden" value="<?php echo $this->session->userdata("invest_email"); ?>" id="email" class="form-control" required>
						<input type="hidden" value="" id="phone_number" class="form-control" required>
						<input type="hidden" value="" id="description" class="form-control" required>
						
						<div class="form-group">
							<label for="amount">Amount</label>
							<input type="number" min="15000" value="" id="amount" class="form-control" required>
							<span class="text-grey mt-3 mb-4 d-block">Minimum Amount: Rp 15.000</span>
						</div>

						<button type="submit" class="btn btn-success btn-block">Proceed</button>
				</form>
				</div>
			</div>
		</div>
	</div>
</section>
  
<script type="text/javascript">
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
			  // console.log(response);
			  data = {
		        amount:response.data.amount,
		        sender_name:response.data.sender_name,
		        status:response.data.status,
		        email:response.data.email,
		      }
		      console.log(data);
		      if(response.data.status=="complete"){
		      $.ajax({
			      method: "POST",
			      url: "<?php echo base_url('investor/saveOy'); ?>",
			      data: data
			      
			    });
		      	window.location.href = '<?= base_url() ?>investor/dana_anda';
		      	sessionStorage.setItem("partner_tx_id", "");
		  		}else{
		  			console.log('not set yet');
		  		}
			});
    	}
    }
	$("#filtyer-form").submit(function (e) {
		e.preventDefault();

		description = document.getElementById('description').value;
		amount = document.getElementById('amount').value;
		name = document.getElementById('name').value;
		email = document.getElementById('email').value;
		phone_number = document.getElementById('phone_number').value;
		key = "d4223670-1abb-491c-be03-c32370774324";
		partner_tx_id = name+parseInt(Date.now()/1000); 
		var settings = {
		  "url": "https://api-stg.oyindonesia.com/api/payment-checkout/create-v2",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
		    "content-type": "application/json",
		    "X-Api-Key": key,
		    "X-Oy-Username": "pendanaid"
		  },
		    "data": JSON.stringify({
			    "description": description,
			    "partner_tx_id": partner_tx_id,
			    "notes": "",
			    "sender_name": name,
			    "amount": amount,
			    "email": email,
			    "phone_number": phone_number,
			    "is_open": true,
			    "step": "input-amount",
			    "include_admin_fee": true,
			    "list_disabled_payment_methods": "",
			    "list_enabled_banks": "002, 008, 009, 013, 022",
			    "list_enabled_ewallet": "shopeepay_ewallet"
			  }),
			};
		$.ajax(settings).done(function (response) {
		  window.sessionStorage.setItem("partner_tx_id", partner_tx_id);
		  // window.location.replace(response.url);
		  window.open(response.url, '_blank');
		  window.location.replace('<?= base_url() ?>investor/dana_anda');		  
		});
	})
</script>
  