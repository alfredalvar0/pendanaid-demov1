 
<br><br>
<section id="team" >
    <div class="container"  >
        <div class="section">
            <!--<div class="row mt-5">
                <div class="col-md-2" align="center">
                    <h4 class="text-left"><b>Laporan Bisnis : </b></h4>
                </div>
				<div class="col-md-10" align="center">
                    <h4 class="text-left"><b><?php echo $bisnis->judul?></b></h4>
                </div>
				 
            </div>-->



             <!-- wrapper content investor-->
            <div class="row mb-5 h-100 mt-5" style="">

            	<?php echo $sidebar; ?>


				<!-- content -->
				<div class="col-lg-9" style="">
          			

					<div class="row mt-5">
		                <div class="col-md-12" align="center">
		                    <h4 class="text-center"><b>Laporan Bisnis : </b></h4>
		                    <h4 class="text-center"><b><?php echo $bisnis->judul?></b></h4>
		                </div>
			        </div>

	          		<div class="row justify-content-center mt-2" style="height: 100%;">


	                	<div class="row mt-2">
				  
							<div class="col-md-12 mt-5 table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th scope="col">No</th> 
										<th scope="col">Id</th>
										<th scope="col">Jenis</th>
										<th scope="col">Lembar Saham</th>
										<th scope="col">Jumlah Dana</th> 
										
										<th scope="col">Tanggal </th>  
									</tr>
								</thead>
								<?php
								if($laporanbisnis->num_rows()>0){
								?>
								<tbody>
									<?php
									$num=0;
									$t1=0;
									$t2=0;
									foreach($laporanbisnis->result() as $par){
										$num++; 
										?>
										<tr>
										<td><?php echo $num; ?></td>
										  
										<td class="text-right"><?php echo  $par->id_dana  ?></td>
										<td class="text-right"><?php echo  $par->type  ?></td>
										<td class="text-right"><?php echo  $par->lembar_saham ; ?></td> 
									<td class="text-right"><?php if($par->jumlah_dana==0){ echo "Ditolak"; }else{ ?>Rp. <?php echo number_format($par->jumlah_dana,0,",","."); } ?></td>
										<td><?php echo date('d F Y', strtotime($par->createddate)); ?></td>
										 
									</tr>
										<?php
									}
									?>
								</tbody>
								<!--<tfoot>
									<tr>
										<td colspan="2">Total</td>
										<td class="text-right">Rp. <?php echo number_format($t1,0,",","."); ?></td>
										<td>&nbsp;</td>
										<td class="text-right">Rp. <?php echo number_format($t2,0,",","."); ?></td>
										<td colspan="2">&nbsp;</td>
									</tr>
								</tfoot>-->
								<?php
								} else {
									?>
									<tbody>
										<tr>
											<td colspan="7" class="text-center">Data tidak ditemukan</td>
										</tr>
									</tbody>
									<?php
								}
								?>
							</table>
							</div>
						</div>
					</div>
				
			</div>



			</div>



			
		</div>
    </div>
</section>
<form id="formpdf" action="<?php echo base_url(); ?>invest/pdfproyeksi" method="post">
	
</form>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>

<script>

	$(document).ready(function(){
		$('#example').DataTable();
		
		$("#export").on("click",function(){
			$('#formpdf').html("");
			var periode=$("#periode option:selected").val();
			$('<input>').attr({
				type: 'hidden',
				id: 'periodepdf',
				name: 'periode',
				value:periode
			}).appendTo($('#formpdf'));
			$('#formpdf').submit();
			/* 
			$.post("<?php echo base_url(); ?>invest/pdfproyeksi", {periode:periode},function(result){
				//alert(result);
			}); */
		});
	});
</script>