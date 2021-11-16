<?php $no = 1; ?>
<?php foreach ($dataReferral->result() as $referral): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $referral->nama_investor ?></td>
      <td><?= $referral->tanggal_join ?></td>
      <td><?= $referral->tanggal_invest ?></td>
      <td><?= $referral->jumlah_invest ?></td>
      <td><?= $referral->no_trx_invest ?></td>
      <td><?= $referral->id_user ?></td>
      <td><?= $referral->id_user ?></td>
      <td><?= $referral->nama_referral ?></td>
      <td><?= $referral->kode_referral ?></td>
      <td>
        <button class="btn btn-sm btn-success"><i class="fa fa-fw fa-thumbs-up"></i> </button>
        <button class="btn btn-sm btn-danger"><i class="fa fa-fw fa-thumbs-down"></i> </button>
        <!-- <label class="label label-success"><i class="fa fa-fw fa-thumbs-up"></i> </label> -->
        <!-- <label class="label label-danger"><i class="fa fa-fw fa-thumbs-down"></i> </label> -->
        <label class="label label-success"><i class="fa fa-fw fa-check"></i> Approved</label>
        <label class="label label-danger"><i class="fa fa-fw fa-times"></i> Declined</label>
      </td>
    </tr>
<?php endforeach; ?>
