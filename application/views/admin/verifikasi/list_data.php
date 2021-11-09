<?php
  $no=1;
  foreach ($dataAkun->result() as $akun) {
    
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $akun->username; ?></td>
      <td><?php echo $akun->email; ?></td>
      <?php if ($akun->tipe == 'admin'){ ?>
        <td>Admin</td>
      <?php }elseif($akun->tipe == 'investor'){ ?>
        <td>Investor</td>
      <?php }elseif($akun->tipe == 'borrower'){ ?>
        <td>Borrower</td>
		<?php }elseif($akun->tipe == 'super admin'){ ?>
        <td>Super Admin</td>
      <?php } ?>

      <?php if ($akun->tipeuser == 'perorangan'){ ?>
        <td>Perorangan</td>
      <?php }elseif($akun->tipeuser == 'perusahaan'){ ?>
        <td>Perusahaan</td>
	  <?php }else{ ?>
        <td>Admin</td>
      <?php } ?>

      <?php if ($akun->login_from == 'web'){ ?>
        <td>Web</td>
      <?php }elseif($akun->login_from == 'fb'){ ?>
        <td>Facebook</td>
      <?php }elseif($akun->login_from == 'google'){ ?>
        <td>Google</td>
	  <?php }else{ ?>
        <td>Admin</td>
      <?php } ?>

      <?php if ($akun->status == 'aktif'){ ?>
        <td >Aktif</td>
      <?php }else{ ?>
        <td>Tidak Aktif</td>
      <?php } ?>

			<?php if ($akun->investstatus == 'aktif'){ ?>
        <td >Aktif</td>
      <?php }else{ ?>
        <td>Tidak Aktif</td>
      <?php } ?>
      
      <td class="text-center" style="min-width:270px;">
        <a href="<?php echo base_url() ?>akun/detailVerifikasi/<?php echo $akun->id_admin ?>">

          <button class="btn btn-info">
            <input type="hidden" name="id_admin" value="<?php echo $akun->id_admin ?>">
            <i class="glyphicon glyphicon-fullscreen"></i> Detail
          </button>
        </a>

				<!--
        <a href="<?php echo base_url() ?>akun/verifikasi/<?php echo $akun->id_admin ?>">

          <button class="btn btn-warning">
            <input type="hidden" name="id_admin" value="<?php echo $akun->id_admin ?>">
            <i class="glyphicon glyphicon-repeat"></i> Set aktif
          </button>
        </a>-->

				<!--<button class="btn btn-success konfirmasiAktif-akun" data-id="<?php echo $akun->id_admin; ?>" data-toggle="modal" data-target="#konfirmasiAktif"><i class="glyphicon glyphicon-check"></i> Set Aktif</button>-->

        <a href="<?php echo base_url() ?>akun/updateVerifikasi/<?php echo $akun->id_admin ?>">

          <button class="btn btn-warning">
            <input type="hidden" name="id_admin" value="<?php echo $akun->id_admin ?>">
            <i class="glyphicon glyphicon-edit"></i> Verifikasi
          </button>
        </a>
        
          <!--<button class="btn btn-danger konfirmasiHapus-akun" data-id="<?php echo $akun->id_admin; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete </button>-->
        
      </td>
    </tr>
    <?php
    $no++;
  }
?>
