<br><br>
<section id="team" >
    <div class="container"  >
        <div class="section">
            <!--<div class="row mt-5">
                <div class="col-12" align="center">
                    <h4 class="text-left"><b>Dokumen Utama</b></h4>
                </div>-->



                <!-- wrapper content investor-->
                <div class="row mb-5 h-100 mt-5" style="">

                    <?php echo $sidebar; ?>


                    <!-- content -->
                    <div class="col-lg-9" style="">
                        

                        <div class="row mt-5">
                            <div class="col-md-12" align="center">
                                <h4 class="text-center"><b>Dokumen Utama</b></h4>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-2" style="height: 100%;">



                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form name="agreement" method="post" enctype="multipart/form-data" action="<?php echo base_url()?>investor/proses_agreement">
                                            <div class="row mt-2">
                                                 <div class="col-md-4" align="center">
                                                    <?php if($data_foto->ttd !=""){ echo '<img style="width:225px;height:150px;border:2px solid grey" src="'.base_url().'assets/img/ttd/'.$data_foto->ttd.'">';}else{?>
                                                    <input type="file" class="dropify" name="ttd" id="imgttd" accept="image/*">
                                                    <?php } ?><br>
                                                    <h5>TTD Digital <?php if($data_foto->foto_ktp !=""){ ?>&nbsp;<a href="<?php echo base_url()?>investor/delete_ttd" style="font-size:14px">(hapus)</a><?php }?></h5>
                                                </div> 
                                                <div class="col-md-4" align="center">
                                                    <?php if($data_foto->foto_ktp !=""){ echo '<img style="width:225px;height:150px;border:2px solid grey" src="'.base_url().'assets/img/dokumen/'.$data_foto->foto_ktp.'">';}else{?>
                                                    <input type="file" class="dropify" name="foto_ktp" id="imgktp" accept="image/*">
                                                    <?php } ?><br>
                                                    <h5>KTP <?php if($data_foto->foto_ktp !=""){ ?>&nbsp;<a href="<?php echo base_url()?>investor/delete_agreement/foto_ktp" style="font-size:14px">(hapus)</a><?php }?></h5>
                                                </div>
                                                <div class="col-md-4" align="center">
                                                    <?php if($data_foto->foto_npwp !=""){ echo '<img style="width:225px;height:150px;border:2px solid grey" src="'.base_url().'assets/img/dokumen/'.$data_foto->foto_npwp.'">';}else{?>
                                                    <input type="file" class="dropify" name="foto_npwp" id="imgnpwp" accept="image/*">
                                                    <?php } ?><br>
                                                    <h5>NPWP <?php if($data_foto->foto_npwp !=""){ ?>&nbsp;<a href="<?php echo base_url()?>investor/delete_agreement/foto_npwp" style="font-size:14px">(hapus)</a><?php }?></h5>
                                                </div>
                                                <div class="col-md-4" align="center">
                                                    <?php if($data_foto->foto_sim !=""){ echo '<img style="width:225px;height:150px;border:2px solid grey" src="'.base_url().'assets/img/dokumen/'.$data_foto->foto_sim.'">';}else{?>
                                                    <input type="file" class="dropify" name="foto_sim" id="imgsim" accept="image/*">
                                                    <?php } ?><br>
                                                    <h5>SIM <?php if($data_foto->foto_sim !=""){ ?>&nbsp;<a href="<?php echo base_url()?>investor/delete_agreement/foto_sim" style="font-size:14px">(hapus)</a><?php }?></h5>
                                                </div>
                                                <div class="col-md-4" align="center">
                                                    <?php if($data_foto->foto_bpjs !=""){ echo '<img style="width:225px;height:150px;border:2px solid grey" src="'.base_url().'assets/img/dokumen/'.$data_foto->foto_bpjs.'">';}else{?>
                                                    <input type="file" class="dropify" name="foto_bpjs" id="imgbpjs" accept="image/*">
                                                    <?php } ?><br>
                                                    <h5>BPJS <?php if($data_foto->foto_bpjs !=""){ ?>&nbsp;<a href="<?php echo base_url()?>investor/delete_agreement/foto_bpjs" style="font-size:14px">(hapus)</a><?php }?></h5>
                                                </div>
                                                <div class="col-md-4" align="center">
                                                    <?php if($data_foto->foto_slipgaji !=""){ echo '<img style="width:225px;height:150px;border:2px solid grey" src="'.base_url().'assets/img/dokumen/'.$data_foto->foto_slipgaji.'">';}else{?>
                                                    <input type="file" class="dropify" name="foto_slipgaji" id="imgslipgaji" accept="image/*">
                                                    <?php } ?><br>
                                                    <h5>Slip Gaji <?php if($data_foto->foto_slipgaji !=""){ ?>&nbsp;<a href="<?php echo base_url()?>investor/delete_agreement/foto_slipgaji" style="font-size:14px">(hapus)</a><?php }?></h5>
                                                </div>
                                                <div class="col-md-12 mt-5" align="right">
                                                    <div class="row justify-content-center">

                                                        <div class="col-md-3">
                                                            <input type="submit" class="btn btn-primary" value="Simpan Dokumen">
                                                        </div>
                                                        <!--
                                                        <div class="">
                                                            <a class="btn btn-default text-dark" href="<?php echo site_url('investor/dokumen_saya'); ?>">
                                                                 Kembali
                                                            </a>
                                                        </div>-->
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                            </div>



                        </div>
                    
                </div>



                </div>






				






            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    var step=0;
    $(document).ready(function(){
		$('#imgttd').dropify();
		$('#imgktp').dropify();
		$('#imgsim').dropify();
		$('#imgslipgaji').dropify();
		$('#imgnpwp').dropify();
		$('#imgbpjs').dropify();
	});
</script>