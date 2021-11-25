<?php
  $no=1;
  foreach ($dataUser->result() as $user) {
    $tamp=$user->foto;
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $user->username; ?></td>
      <td><?php echo $user->nama; ?></td>
      <td><?php echo $user->email; ?></td>
      <td><?php echo $user->tanggal_lahir; ?></td>
      <td>
        <img class="profile-user-img img-responsive img-square" src="<?php
            if($tamp == ''){
          echo base_url('assets/img/not.png');
          // echo file_exists('assets/img/not.png');
        }
          else
          {
            echo base_url(); ?>assets/img/user/<?php echo $tamp; 

          }
         ?>" alt="User profile picture">
      </td>
      <td><?php echo $user->alamat; ?></td> 
      <td><?php echo $user->domisili; ?></td>
      <td><?php echo $user->kota; ?></td>
      <td><?php echo $user->kodepos; ?></td>
      <td><?php echo $user->telephone; ?></td>
      <td><?php echo $user->handphone; ?></td>
      <td><?php echo $user->pekerjaan; ?></td>
      <?php if ($user->status == 0){ ?>
        <td>Lajang</td>
      <?php } else{ ?>
        <td>Menikah</td>
      <?php } ?>
      <?php if ($user->login_form == 1) { ?>
        <td>Web</td>
      <?php }elseif ($user->login_form == 2) { ?>
        <td>Facebook</td>
      <?php } elseif ($user->login_form == 3) { ?>
        <td>Twiter</td>
      <?php } ?>

      <td class="text-center" style="min-width:270px;">
        <a href="<?php echo base_url() ?>user/update/<?php echo $user->id_user ?>">

          <button class="btn btn-warning">
            <input type="hidden" name="id_user" value="<?php echo $user->id_user ?>">
            <i class="glyphicon glyphicon-repeat"></i> Update
          </button>
        </a>
      
      </td>
    </tr>
    <?php
    $no++;
  }
?>
