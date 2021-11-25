<?php
  $no=1;
  foreach ($dataMasterPage->result() as $page) {
    
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $page->judul; ?></td>
      <td><?php echo $page->link_page; ?></td>
      
      <?php if ($page->kategori == 'header'){ ?>
        <td>Header</td>
      <?php }elseif($page->kategori == 'sidebar'){ ?>
        <td>Sidebar</td>
      <?php }elseif($page->kategori == 'footer'){ ?>
        <td>Footer</td>
      <?php }elseif($page->kategori == 'footer2'){ ?>
        <td>Footer2</td>
      <?php }elseif($page->kategori == 'perhatian'){ ?>
        <td>Perhatian</td>
      <?php } ?>
       <td><?php echo $page->sort_number; ?></td>
	   <td><?php echo $page->status_delete=="0"?"Aktif":"Tidak Aktif"; ?></td>
      <td class="text-center" style="min-width:270px;">
        <a href="<?php echo base_url() ?>MasterPage/update/<?php echo $page->id_page ?>">
          <button class="btn btn-warning">
            <input type="hidden" name="id_page" value="<?php echo $page->id_page ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>
        
          <button class="btn btn-danger konfirmasiHapus-mstpage" data-id="<?php echo $page->id_page; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
        
      </td>
    </tr>
    <?php
    $no++;
  }
?>
