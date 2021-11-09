<br><br><br>
<section id="team" >
    <div class="container"  >
        <div class="section">
            <div class="row mt-5">
                <div class="col-12" align="center">
                    <img src="<?php echo base_url(); ?>assets/img/jempol.png" width="250px" />
                    <h3>
                    <?php
                    echo $this->session->flashdata("act")." ".$this->session->flashdata("hasil").", sebesar Rp. ".number_format($this->session->flashdata("jumlah"),0,".",".")." pada tanggal ".$this->session->flashdata("tanggal");
                    ?>
                    </h3>
					<p class="text-center">Terima kasih telah melakukan investasi. Silahkan periksa email anda untuk melakukan verifikasi. </p>
                </div>
            </div>
        </div>
    </div>
</section>