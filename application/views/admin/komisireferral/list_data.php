<?php $no = 1; ?>
<?php foreach ($dataReferral->result() as $referral): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $referral->judul ?></td>
      <td><?= $referral->persen_komisi ?></td>
      <td><?= '-' ?></td>
      <td>
        <a href="<?= base_url('komisireferral/update/'.$referral->id) ?>" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i> </a>
      </td>
    </tr>
<?php endforeach; ?>
