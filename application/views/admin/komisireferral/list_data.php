<?php $no = 1; ?>
<?php foreach ($dataReferral->result() as $referral): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $referral->judul ?></td>
      <td><?= $referral->persen_komisi ?></td>
      <td>
        <?php if (!empty($referral->id)): ?>
          <a href="<?= base_url('komisireferral/update/'.$referral->id) ?>" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i> </a>
        <?php else: ?>
          <a href="<?= base_url('komisireferral/insert/'.$referral->id_produk) ?>" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i> </a>
        <?php endif; ?>
      </td>
    </tr>
<?php endforeach; ?>
