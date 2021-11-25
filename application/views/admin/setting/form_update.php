<div class="content-wrapper">

  <div class=" col-md-12 well">

    <div class="form-msg"></div>

    <h3 style="display:block; text-align:center;">Setting Data</h3>



    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Setting/prosesUpdate">

      <input type="hidden" name="id_admin" value="<?php echo $dataSetting->id_admin ?>">

      <div class="box-body">

        <!-- Username -->

        <div class="form-group">

          <label for="inputEmail3" class="col-sm-2 control-label">Username</label>



          <div class="col-sm-10">

            <input type="text" class="form-control" placeholder="Username" name="username" aria-describedby="sizing-addon2" value="<?php echo $dataSetting->username ?>" readonly>

          </div>

        </div>



        <!-- Password -->

        <div class="form-group">

          <label for="inputEmail3" class="col-sm-2 control-label">Password</label>



          <div class="col-sm-10">

            <input type="password" class="form-control" placeholder="Password" name="password" aria-describedby="sizing-addon2" value="<?php //echo $dataSetting->password ?>">

          </div>

        </div>



        <!-- Nama -->

        <!-- <div class="form-group">

          <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>



          <div class="col-sm-10">

            <input type="text" class="form-control" placeholder="Nama" name="nama" aria-describedby="sizing-addon2" value="<?php echo $dataSetting->nama ?>">

          </div>

        </div> -->



        <!-- Email -->

        <div class="form-group">

          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>



          <div class="col-sm-10">

            <input type="text" class="form-control" placeholder="Email" name="email" aria-describedby="sizing-addon2" value="<?php echo $dataSetting->email ?>">

          </div>

        </div>





      </div>



      <div class="form-group">

        <div class="col-md-3">

          

        </div>



        <div class="col-md-3">

            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>

        </div>

        

        <div class="col-md-3">

          <a href="<?php echo base_url() ?>Admin/home" class="form-control btn btn-danger">

            <i class="glyphicon glyphicon-remove"></i> Kembali

          </a>

        </div>



        <div class="col-md-3">

          

        </div>

    

      </div>

    </form>

    

  </div>

</div>

