<section class="register-2">
    <div class="container py-5">
        <h1 class="text-center font-red-hat-display font-weight-bold mb-5">Tentukan Pilihan Anda</h1>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="row">
                    <div class="col-md-6 my-2 my-md-4">
                        <form action="<?= base_url(); ?>invest/login_choice" method="POST" class="text-center">
                            <input type="hidden" name="user_reg" value="<?php echo $user_reg; ?>" />
                            <input type="hidden" name="pass_reg" value="<?php echo $pass_reg; ?>" />
                            <input type="hidden" name="role_reg" value="investor" />
                            <button type="submit" class="w-100 bg-transparent border button-choose" style="outline: 0;">
                                <embed name="E" id="E" src="<?php echo base_url() ?>assets/img/ico-investor.svg" width="100px" height="100px">
                                <h2 class="font-weight-bold text-center">Investor</h2>
                                <p class="m-0 text-center text-grey">Daftar Sebagai Pemberi Investasi</p>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6 my-2 my-md-4">
                        <form action="" method="POST" class="text-center">
                            <input type="hidden" name="user_reg" value="<?php echo $user_reg; ?>" />
                            <input type="hidden" name="pass_reg" value="<?php echo $pass_reg; ?>" />
                            <input type="hidden" name="role_reg" value="investor" />
                            <button type="submit" class="w-100 bg-transparent border button-choose" style="outline: 0;">
                                <embed name="E" id="E" src="<?php echo base_url() ?>assets/img/ico-borrower.svg" width="100px" height="100px">
                                <h2 class="font-weight-bold text-center">Bisnis</h2>
                                <p class="m-0 text-center text-grey">Daftar Sebagai Pemilik Bisnis</p>
                            </button>
                        </form>
                    </div>
                </div>
                <p class="text-center text-grey mt-3">Sudah Punya Akun? <a href="<?= base_url(); ?>invest/login" class="text-blue font-weight-bold">Masuk</a></p>
            </div>
        </div>
    </div>
</section>