
<br><br>
<section id="team" >
    <div class="container"  >
        <div class="section">
            <div class="row mt-5">
                <div class="col-md-3" align="center">
                    <h4 class="text-left"><b>Laporan Bisnis Gadai : </b></h4>
                </div>
				<div class="col-md-7" align="center">
                    <h4 class="text-left"><b><?php echo $bisnis->judul?></b></h4>
                </div>
				 <div class="col-md-2" align="center">
                    <a href="<?php echo base_url()?>investor/gadai/<?php echo $bisnis->siteurl?>" class="btn btn-success">Mulai Gadai Saham</a>
                </div> 
            </div>
			<div class="row mt-2">
				  
				<div class="col-md-12 mt-5 table-responsive">
				<table id="example" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							 <th scope="col">ID</th> 
							<th scope="col">Tanggal </th> 
							<th scope="col">Saham</th>
							<th scope="col">Jumlah Diterima</th>  
							<th scope="col">Status </th>	
							<th scope="col">Action </th>							
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
							 <td><?php echo $par->id_jual; ?></td> 
							<td><?php echo date('d F Y', strtotime($par->createddate)); ?></td>  
							<td><?php echo $par->lembar_saham; ?> Lembar</td>
							<td class="text-right">Rp. <?php echo number_format($par->jumlah_dana,0,",","."); ?></td>   
							<td><?php echo $par->status_approve; ?></td>
							<td>
							<?php if( $par->status_approve=="approve"){ ?>
							<button onclick="tebus('<?php echo $par->id_jual; ?>')" class="btn btn-primary">Tebus</button>
							<?php } ?>
							</td>
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
	
	
	function tebus(id){
		Swal.fire({
		  title: 'Peringatan',
		  text: "Yakin akan membeli kembali saham ini?",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes'
		}).then((result) => {
		  if (result.value) {
			  var  idproduk = <?php echo $id_produk?>;
			window.location.href = "<?php echo base_url()?>invest/doGadaiTebus/"+id+"/"+idproduk; 
		  }
		})
	}
</script>