<?php
  $no=1;
  foreach ($dataKategori->result() as $kategori) {
    
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kategori->kategori; ?></td>
      
      <td class="text-center" style="min-width:270px;">
        

        <a href="<?php echo base_url() ?>kategori/update/<?php echo $kategori->id_kategori ?>">

          <button class="btn btn-warning">
            <input type="hidden" name="id_kategori" value="<?php echo $kategori->id_kategori ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>
        
          <button class="btn btn-danger konfirmasiHapus-kategori" data-id="<?php echo $kategori->id_kategori; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete </button>
        
      </td>
    </tr>
    <?php
    $no++;
  }
?>
