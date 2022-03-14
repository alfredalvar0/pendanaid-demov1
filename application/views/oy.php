<section id="content">
	<div class="container py-5">
		<div class="row">
			<div class="col-md-8 col-lg-6 mx-auto">
				<h1 class="mb-5 text-center" style="font-weight: 700; font-size: 28px;">Daftar Rekening Deposit</h1>
				<div class="card card-body">
					<p style="font-size: 20px; font-weight: 700;">Check Out Form</p>

					<form id="filtyer-form" method="post" action="<?php echo base_url() ?>investor/saveOy">
						<input type="hidden" value="<?php echo $this->session->userdata("invest_pengguna"); ?>" name="id_pengguna" class="form-control" required>
						<input type="hidden" value="<?php echo $this->session->userdata("invest_username"); ?>" name="name" class="form-control" required>
						<input type="hidden" value="<?php echo $this->session->userdata("invest_email"); ?>" name="email" class="form-control" required>
						<input type="hidden" value="" id="phone_number" class="form-control" required>
						<input type="hidden" value="" id="description" class="form-control" required>
						
						<div class="form-group">
							<label for="amount">Amount</label>
							<input type="number" min="15000" value="" name="amount" class="form-control" required>
							<span class="text-grey mt-3 mb-4 d-block">Minimum Amount: Rp 15.000</span>
						</div>

						<button type="submit" class="btn btn-success btn-block">Proceed</button>
				</form>
				</div>
			</div>
		</div>
	</div>
</section>
  
<!-- <script type="text/javascript">
	$("#filtyer-form").submit(function (e) {
		e.preventDefault();

		description = document.getElementById('description').value;
		amount = document.getElementById('amount').value;
		name = document.getElementById('name').value;
		email = document.getElementById('email').value;
		phone_number = document.getElementById('phone_number').value;

		// key = "d4223670-1abb-491c-be03-c32370774324"; -- api key staging
		key = "73560ae7-9fc3-4fbf-8a81-bacb6e2e6a30"; // api key prod
		partner_tx_id = name+parseInt(Date.now()/1000); 
		var settings = {
		  // "url": "https://api-stg.oyindonesia.com/api/payment-checkout/create-v2",
		  "url": "https://partner.oyindonesia.com/api/payment-checkout/create-v2",
		  "method": "POST",
		  "timeout": 0,
		  "crossDomain": true,
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

		var data = JSON.stringify({
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
		});

		$.ajax(settings).done(function (response) {
		  window.sessionStorage.setItem("partner_tx_id", partner_tx_id);
		  // window.location.replace(response.url);
		  // window.open(response.url, '_blank');

		  	var a = document.createElement('a');
		  	a.href = response.url;
		  	a.setAttribute('target', '_blank');
		  	a.id = "new_id";
		  	document.getElementById("new_id").click;
		  window.location.replace('<?= base_url() ?>investor/dana_anda');		  
		});
	})
</script> -->
  