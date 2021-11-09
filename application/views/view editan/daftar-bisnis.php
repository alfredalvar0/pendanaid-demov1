 
   <br><br><br>
    
    <!--==========================
       Login Section
    ============================-->
    
     <?php //if($this->session->userdata("invest_username")==""){echo "<br><br><br><br>";}?>
	<br><br><br><br>
    <section id="team">
      <div class="container">
        <div class="section-header">
          <h3><b>Daftar Bisnis<b></h3> 
        </div>
        
        <div class="row wow fadeInUp">
		<?php foreach($databisnis->result() as $par){?>
			<div class=" col-md-4 mt-5" style=" ">
				<div class="row">
					<div class="col-md-12 text-center" >
						<img src="<?php echo base_url()?>assets/img/bisnis/<?php echo $par->foto?>" style="width:100%">
						<h3><b><?php echo $par->nama_binsis?></b></h3>
					
						<p><?php echo substr($par->tentang_bisnis,0,250);?>...</p>
					</div>
				</div>
				
			</div> 
		<?php } ?>
		</div>
	 </div>
    </section><!-- #team -->
     <?php if($this->session->userdata("invest_username")==""){echo "<br><br><br><br>";}?>
	 
    
 