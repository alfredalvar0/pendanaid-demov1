<?php $no = 1; ?>
<?php foreach ($dataReferral->result() as $referral): ?>
  <?php $komisi = $referral->jumlah_invest * ($referral->persen_komisi / 100); ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $referral->nama_investor ?><br><small><?= $referral->email_investor ?></small></td>
      <td><?= date('d/m/Y H:i:s', strtotime($referral->tanggal_join)) ?></td>
      <td><?= date('d/m/Y H:i:s', strtotime($referral->tanggal_invest)) ?></td>
      <td><?= $referral->judul ?></td>
      <td><?= number_format($referral->jumlah_invest, 0, ',', '.') ?></td>
      <td><?= $referral->no_trx_invest ?></td>
      <td><?= number_format($komisi, 0, ',', '.') ?> (<?= $referral->persen_komisi ?>%)</td>
      <td><?= $referral->nama_referral ?> (<?= $referral->kode_referral ?>)<br><small><?= $referral->email_referral ?></small></td>
      <td>
        <?php if($referral->status == "0"): ?>
          <label class="label label-danger"><i class="fa fa-fw fa-thumbs-down"></i> Refused</label>
        <?php elseif($referral->status == "1"): ?>
          <label class="label label-success"><i class="fa fa-fw fa-thumbs-up"></i> Approved</label>
        <?php else: ?>
          <label class="label label-default"><i class="fa fa-fw fa-clock-o"></i> Pending</label>
        <?php endif; ?>
      </td>
      <td>
        <?php if($referral->status === null): ?>
          <a href="<?= base_url('Referralmanagement/update/'.$referral->id_user.'/'.$referral->no_trx_invest) ?>" class="btn btn-xs btn-flat btn-warning"><i class="fa fa-fw fa-edit"></i></a>
        <?php else: ?>
          <a href="<?= base_url('Referralmanagement/detail/'.$referral->id_user.'/'.$referral->no_trx_invest) ?>" class="btn btn-xs btn-flat btn-info"><i class="fa fa-fw fa-eye"></i></a>
        <?php endif; ?>
      </td>
    </tr>
<?php endforeach; ?>
