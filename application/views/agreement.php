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
                                                    <?php if($data_foto->foto_ktp !=""){ echo '<img style="width:225px;height:150px;border:2px solid grey" src="'.base_url().'assets/img/dokumen/ktp/'.$data_foto->foto_ktp.'">';}else{?>
                                                    <input type="file" class="dropify" name="foto_ktp" id="imgktp" accept="image/*">
                                                    <?php } ?><br>
                                                    <h5>KTP</h5>
                                                </div>
                                                <div class="col-md-4" align="center">
                                                    <?php if($data_foto->foto_npwp !=""){ echo '<img style="width:225px;height:150px;border:2px solid grey" src="'.base_url().'assets/img/dokumen/npwp/'.$data_foto->foto_npwp.'">';}else{?>
                                                    <input type="file" class="dropify" name="foto_npwp" id="imgnpwp" accept="image/*">
                                                    <?php } ?><br>
                                                    <h5>NPWP</h5>
                                                </div>
                                                <div class="col-md-4" align="center">
                                                    <?php if($data_foto->buku_tabungan !=""){ echo '<img style="width:225px;height:150px;border:2px solid grey" src="'.base_url().'assets/img/dokumen/buku_tabungan/'.$data_foto->buku_tabungan.'">';}else{?>
                                                    <input type="file" class="dropify" name="buku_tabungan" id="imgsim" accept="image/*">
                                                    <?php } ?><br>
                                                    <h5>Buku Tabungan</h5>
                                                </div>
                                                <div class="col-md-4" align="center">
                                                    <?php if($data_foto->selfie !=""){ echo '<img style="width:225px;height:150px;border:2px solid grey" src="'.base_url().'assets/img/dokumen/selfie/'.$data_foto->selfie.'">';}else{?>
                                                    <input type="file" class="dropify" name="selfie" id="imgbpjs" accept="image/*">
                                                    <?php } ?><br>
                                                    <h5>Selfie</h5>
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