<?php
class M_invest extends CI_Model {

  public function __construct(){
    parent::__construct();
        // Your own constructor code
    $this->load->database();
    $lib=array("phpmailer_library","session");
    $this->load->library($lib);
  }

  public function checkUser($wh=""){
    $this->db->select("a.username,a.email,a.tipe,a.status,b.id_pengguna,b.no_hp,b.nama_pengguna,verif");
    $this->db->from("tbl_admin a");
    $this->db->join("tbl_pengguna b","b.id_admin=a.id_admin","left");
        // $this->db->join("tbl_pengguna b","b.id_pengguna=a.id_admin","left");
        //$this->db->join("tbl_bank_pengguna c","c.id_pengguna=b.id_pengguna","left");
    if($wh!=""){
      $this->db->where($wh);
    }
    return $this->db->get();
  }

  public function checkOtp($wh = "")
  {
    return $this->db->select('id_admin')
    ->from('tbl_admin')
    ->where($wh)
    ->get()->num_rows();
  }

  public function checkUserInvest($wh=""){
    $this->db->select("a.username,a.email,a.tipe,a.status,b.id_pengguna,b.no_hp,b.nama_pengguna,verif");
    $this->db->from("tbl_admin a");
    $this->db->join("tbl_pengguna b","b.id_admin=a.id_admin","left");
        //$this->db->join("tbl_bank_pengguna c","c.id_pengguna=b.id_pengguna","left");
    if($wh!=""){
      $this->db->where($wh);
    }
    return $this->db->row();
  }

  public function checkPengguna($wh=""){
    $this->db->select("a.id_admin,b.id_pengguna,a.username,a.email AS mailto,a.tipe,a.status,b.id_pengguna,b.no_hp,b.nama_pengguna,a.reset_token,a.reset_exp");
    $this->db->from("tbl_admin a");
    $this->db->join("tbl_pengguna b","b.id_admin=a.id_admin","left");
    if($wh!=""){
      $this->db->where($wh);
    }
    return $this->db->get();
  }
  public function kirimEmailnya($email,$message){
    date_default_timezone_set('Etc/UTC');
    $wh=array("mail_company"=>"PT. Pendana Usaha");
    $mailserver = $this->mailserver($wh)->row();
    $mail = $this->phpmailer_library->load(true);

    try {
     $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );
     $mail->CharSet = "UTF-8";
     $mail->IsSMTP();
    		$mail->SMTPSecure = $mailserver->smtp_crypto;//'ssl';
    		$mail->Host = $mailserver->smtp_host;//"mail.nata.id"; //hostname masing-masing provider email
    		$mail->SMTPDebug = 0;
    		$mail->Port = $mailserver->smtp_port;//465;
    		$mail->SMTPAuth = true;
    		$mail->Username = $mailserver->smtp_user;  //user email
    		$mail->Password = $mailserver->smtp_pass;  //password email
    		$mail->SetFrom($mailserver->smtp_user,"Pendana Usaha"); //set email pengirim
    		$mail->AddAddress($email,"User"); //tujuan email
        $mail->isHTML(true);
            $mail->Subject = "Pemberitahuan Email dari Website"; //subyek email
            $mail->Body=html_entity_decode($message);
            $mail->ContentType = 'text/html';
			//$mail->SMTPDebug  = 1;
            //$mail->MsgHTML($message);
            if($mail->Send()){
    			// echo "Message has been sent";

             return 'success';
           }
           else{
    			// echo "Failed to sending message";
    			return $mail->ErrorInfo;//'fail';
    		}
      } catch (Exception $e) {
            //echo 'Message could not be sent.';
        return 'Mailer Error: ' . $mail->ErrorInfo;
      }
    }
    public function mailserver($wh=""){
      $this->db->select('*');
      $this->db->from('mail_server');
      if($wh!=""){
        $this->db->where($wh);
      }
      return $this->db->get();
    }
    public function slider($wh=""){
      $this->db->select('*');
      $this->db->from('tbl_slider');
      if($wh!=""){
        $this->db->where($wh);
      }
      $this->db->order_by('created_date',"desc");
      return $this->db->get();
    }
    public function banner($wh=""){
      $this->db->select('*');
      $this->db->from('tbl_banner');
      if($wh!=""){
        $this->db->where($wh);
      }
      return $this->db->get();
    }
    function get_file_extension($file_name) {
      return substr(strrchr($file_name,'.'),1);
    }
    public function refferal_setting($wh=""){
      $this->db->select('*');
      $this->db->from('tbl_setting');
      if($wh!=""){
        $this->db->where($wh);
      }
      return $this->db->get();
    }
    public function dataBank($wh=""){
      $this->db->select("*");
      $this->db->from("tbl_bank_pengguna");
      if($wh!=""){
        $this->db->where($wh);
      }
      return $this->db->get();
    }
    public function dataBanks($wh=""){
      $this->db->select("*");
      $this->db->from("tbl_bank");
      if($wh!=""){
        $this->db->where($wh);
      }
      return $this->db->get();
    }
    public function dataAgama($wh=""){
      $this->db->select("*");
      $this->db->from("tbl_agama");
      if($wh!=""){
        $this->db->where($wh);
      }
      return $this->db->get();
    }
    public function dataPendidikan($wh=""){
      $this->db->select("*");
      $this->db->from("tbl_pendidikan");
      if($wh!=""){
        $this->db->where($wh);
      }
      return $this->db->get();
    }
    public function dataNegara($wh=""){
      $this->db->select("*");
      $this->db->from("tbl_negara");
      if($wh!=""){
        $this->db->where($wh);
      }
      return $this->db->get();
    }
    public function dataProvinsi($wh=""){
      $this->db->select("*");
      $this->db->from("tbl_provinsi");
      if($wh!=""){
        $this->db->where($wh);
      }
      return $this->db->get();
    }
    public function dataKabKota($wh=""){
      $this->db->select("a.*,b.name as provinsi");
      $this->db->from("tbl_kabkota a");
      $this->db->join("tbl_provinsi b",'b.id=a.province_id','left');
      if($wh!=""){
        $this->db->where($wh);
      }
      return $this->db->get();
    }

    public function dataPenghasilan($wh=""){
      $this->db->select("a.*");
      $this->db->from("tbl_penghasilan a");
      if($wh!=""){
        $this->db->where($wh);
      }
      return $this->db->get();
    }

    public function dataPekerjaan($wh="")
    {
      $this->db->select("a.*");
      $this->db->from("tbl_profesi a");
      if($wh!=""){
        $this->db->where($wh);
      }
      return $this->db->get();
    }

    public function dataSumAllProduk($wh=""){
      $query=array();
      $this->db->select("'Proyek' as title,coalesce(count(*),0) as jum");
      $this->db->from("trx_produk");
      if($wh!=""){
        $this->db->where($wh);
      }
		$query[]= $this->db->get_compiled_select(); // It resets the query just like a get()

		$this->db->select("'Investor Terdaftar' as title,coalesce(count(*),0) as jum");
		$this->db->distinct();
		$this->db->from("tbl_pengguna p");
		$this->db->join("tbl_admin a","a.id_admin=p.id_admin","left");
		$this->db->where("a.status","aktif");
		$query[] = $this->db->get_compiled_select();


		$query = $this->db->query(implode(" UNION ",$query));

		return $query;
	}

	public function danaTerkumpul(){
		$this->db->select("'Dana Terkumpul' as title,coalesce(i.jumlah_dana,0) as jum");
		//$this->db->distinct();
		$this->db->from("trx_dana_invest i");
		$this->db->join("trx_produk p","p.id_produk=i.id_produk","left");
		$this->db->where("i.status_approve","approve");
		return $this->db->get();
	}

	public function keuntunganDibagikan(){
		$this->db->select("'Keuntungan dibagikan' as title,(coalesce(i.jumlah_dana,0)*coalesce(p.finansial_dividen,0))/100 as jum");
		$this->db->distinct();
		$this->db->from("trx_dana_invest i");
		$this->db->join("trx_produk p","p.id_produk=i.id_produk","left");
		$this->db->where("i.status_approve","approve");
		return $this->db->get();
	}

	public function dataBisnis($wh=""){
		$this->db->select("*");
    $this->db->from("tbl_bisnis");
    if($wh!=""){
      $this->db->where($wh);
    }
    return $this->db->get();
  }

  public function dataProduk($wh="",$or="",$idpengguna="",$whi=""){
    $this->db->select("kt.kategori,bs.foto as fotobisnis,bs.nama_binsis,p.*,coalesce(p.harga_perlembar,0) as harga_perlembar,p.status_approve as stsapprove_produk,coalesce(i.invested,0) as invested,i.status_approve,coalesce(i.terkumpul,0) as terkumpul");
    $this->db->from("trx_produk p");
    $whid="";
    if($idpengguna!=""){
     $whid=" where id_pengguna='".$idpengguna."' ";
   }
   $this->db->join("tbl_bisnis bs","bs.id_bisnis=p.id_bisnis","left");
   $this->db->join("tbl_kategori kt","kt.id_kategori=bs.id_kategori","left");
   $this->db->join("(select id_produk, status_approve,count(*) as invested,sum(jumlah_dana) as terkumpul from trx_dana_invest ".$whid." group by id_produk, status_approve) i","i.id_produk=p.id_produk","left");



   if($wh!=""){
    $this->db->where($wh);
  }
  if($whi!=""){
   foreach($whi as $key=>$val){
    $this->db->where_in($key,$val);
  }
}
if($or!=""){
 foreach($or as $fi=>$val){
  $this->db->order_by($fi,$val);
}
}
return $this->db->get();
}

public function dataProdukSekunder($wh="",$or="",$idpengguna="",$whi=""){

  $this->db->select("
    ps.maks_harga_perlembar,
    ps.min_harga_perlembar,
    ps.nilai_biaya_admin,
    ps.jenis_biaya_admin,
    kt.kategori,
    bs.foto AS fotobisnis,
    bs.nama_binsis,
    p.*,
    p.status_approve AS stsapprove_produk,
    COALESCE ( i.invested, 0 ) AS invested,
    i.status_approve,
    COALESCE ( i.terkumpul, 0 ) AS terkumpul
    ");
  $this->db->from("trx_produk p");
  $whid="";

  if($idpengguna!=""){
   $whid=" where id_pengguna='".$idpengguna."' ";
 }

		// $this->db->join("trx_dana_invest_jual jl","jl.id_produk=p.id_produk");
 $this->db->join("tbl_bisnis bs","bs.id_bisnis=p.id_bisnis","left");
 $this->db->join("tbl_kategori kt","kt.id_kategori=bs.id_kategori","left");
 $this->db->join("(select id_produk, status_approve,count(*) as invested,sum(jumlah_dana) as terkumpul from trx_dana_invest ".$whid." group by id_produk) i","i.id_produk=p.id_produk","left");
 $this->db->join("trx_produk_pasar_sekunder ps","ps.id_produk = p.id_produk","left");
		// $this->db->where("jl.status_approve", "approve");
 $this->db->where("ps.publish", 1);

 if($wh!=""){
  $this->db->where($wh);
}

if($whi!=""){
 foreach($whi as $key=>$val){
  $this->db->where_in($key,$val);
}
}

if($or!=""){
 foreach($or as $fi=>$val){
  $this->db->order_by($fi,$val);
}
}

$this->db->group_by('id_produk');
$this->db->order_by('datecreated', 'desc');
return $this->db->get();
}

public function dataTotalinvest($wh=""){
  $this->db->select("sum(jumlah_dana) as total, sum(lembar_saham) as lembar");
  $this->db->from("trx_dana_invest");

  if($wh!=""){
    $this->db->where($wh);
  }
  return $this->db->get();
}

public function dataTotalInvestRefund($wh="")
{
  $this->db->select("sum(jumlah_dana) as total, sum(lembar_saham) as lembar");
  $this->db->from('trx_dana_invest_refund');

  if ($wh != "") {
    $this->db->where($wh);
  }

  return $this->db->get();
}

public function dataTotalinvestSekunder($wh=""){
  $this->db->select("sum(jumlah_dana) as total, sum(lembar_saham) as lembar");
  $this->db->from("trx_dana_invest_jual");

  if($wh!=""){
    $this->db->where($wh);
  }
  return $this->db->get();
}

public function dataTotalinvestJual($wh=""){
  $this->db->select("sum(jumlah_dana) as total, sum(lembar_saham) as lembar");
  $this->db->from("trx_dana_invest_jual");

  if($wh!=""){
    $this->db->where($wh);
  }
  return $this->db->get();
}

public function dataTotalinvestJualSekunder($wh=""){
  $this->db->select("sum(total) as total, sum(lembar_saham) as lembar");
  $this->db->from("trx_pasar_sekunder");
  $this->db->where('jenis_transaksi', 'jual');

  if($wh!=""){
    $this->db->where($wh);
  }
  return $this->db->get();
}

public function dataTotalinvestGadai($wh=""){
  $this->db->select("sum(jumlah_dana) as total, sum(lembar_saham) as lembar");
  $this->db->from("trx_dana_invest_gadai");

  if($wh!=""){
    $this->db->where($wh);
  }
  return $this->db->get();
}



public function dataTotalinvestor($wh=""){
  $this->db->select("id_pengguna");
  $this->db->from("trx_dana_invest");
  $this->db->group_by('id_pengguna');
  if($wh!=""){
    $this->db->where($wh);
  }
  return $this->db->get();
}

public function dataSisasaham($wh=""){
  $this->db->select("sum(jumlah_dana) as total");
  $this->db->from("trx_dana_invest");

  if($wh!=""){
    $this->db->where($wh);
  }
  return $this->db->get();
}

public function dataProdukDtl($wh=""){
  $this->db->select("bs.foto as fotobisnis,kt.kategori,bs.nama_binsis,p.*,p.status_approve as stsapprove_produk,coalesce(i.invested,0) as invested,i.status_approve,coalesce(i.terkumpul,0) as terkumpul,coalesce(a.angsuran_ke,0) as angsuran_ke");
  $this->db->from("trx_produk p");
  $whid="";
  $this->db->join("tbl_bisnis bs","bs.id_bisnis=p.id_bisnis","left");
  $this->db->join("tbl_kategori kt","kt.id_kategori=bs.id_kategori","left");
  $this->db->join("(select id_produk, status_approve,count(*) as invested,sum(jumlah_dana) as terkumpul from trx_dana_invest ".$whid." group by id_produk) i","i.id_produk=p.id_produk","left");
  $this->db->join("(select id_produk, max(angsuran_ke) as angsuran_ke from trx_dana ".$whid." group by id_produk) a","a.id_produk=p.id_produk","left");

  if($wh!=""){
    $this->db->where($wh);
  }
  return $this->db->get();
}
public function dataProdukInvest($wh=""){
  $id_pengguna = $this->session->userdata("invest_pengguna");
  $this->db->select("p.*,coalesce(i.invested,0) as invested");
  $this->db->from("trx_produk p");
  $this->db->join("(select id_produk, count(*) as invested from trx_dana_invest where id_pengguna='".$id_pengguna."' group by id_produk) i","i.id_produk=p.id_produk","left");
  if($wh!=""){
    $this->db->where($wh);
  }
  return $this->db->get();
}

public function dataProdukInvestUser($wh="",$whi=""){

  $this->db->select("a.jumlah_dana as invested, b.*");
  $this->db->from("trx_dana_invest a");
  $this->db->join("trx_produk b","a.id_produk=b.id_produk","left");
  if($wh!=""){
    $this->db->where($wh);
  }
  if($whi!=""){
   foreach($whi as $key=>$val){
    $this->db->where_in($key,$val);
  }
}
return $this->db->get();
}

public function danaInvestasi($wh=""){

  $this->db->select("sum(jumlah_dana) as total");
  $this->db->from("trx_dana_invest");
  if($wh!=""){
    $this->db->where($wh);
  }
  $result = $this->db->get();
  return $result->row();
}

public function danaInvestasiBunga($wh=""){

  $this->db->select("b.bagi_hasil, a.jumlah_dana ");
  $this->db->from("trx_dana_invest a");
  $this->db->join("trx_produk b","a.id_produk=b.id_produk","left");
  if($wh!=""){
    $this->db->where($wh);
  }

  return $this->db->get();
}


    //borrower produk invest
public function dataProdukBorrower($wh=""){

  $this->db->select("a.invested, b.*");
  $this->db->from("trx_produk b");
  $this->db->join("(select id_produk,status_approve,sum(jumlah_dana) as invested from trx_dana_invest group by id_produk) a","a.id_produk=b.id_produk","left");
        //$this->db->from("trx_dana_invest a");
		//$this->db->join("trx_produk b","a.id_produk=b.id_produk","left");
  if($wh!=""){
    $this->db->where($wh);
  }
  return $this->db->get();
}

public function danaInvestasiBrorrower($wh=""){

  $this->db->select("sum(a.jumlah_dana) as total");
  $this->db->from("trx_dana_invest a");
  $this->db->join("trx_produk b","a.id_produk=b.id_produk","left");
  if($wh!=""){
    $this->db->where($wh);
  }
  $result = $this->db->get();
  return $result->row();
}



public function getPage($wh=""){
  $this->db->select("*");
  $this->db->from("tbl_page");
  if($wh!=""){
    $this->db->where($wh);
  }
  $this->db->order_by('sort_number','asc');
  return $this->db->get();
}
public function getLink($wh=""){
  $this->db->select("*");
  $this->db->from("tbl_link");
  if($wh!=""){
    $this->db->where($wh);
  }
  return $this->db->get();
}
public function dataDanaInvest($wh=""){
  $this->db->select("i.id_pengguna,i.jumlah_dana,i.status_approve,i.id_produk,i.createddate,p.siteurl,p.judul,p.finansial_dividen,p.tglakhir, p.finansial_dividen_waktu as jangka");
  $this->db->distinct();
  $this->db->from("trx_dana_invest i");
  $this->db->join("trx_produk p","p.id_produk=i.id_produk","left");
  if($wh!=""){
    $this->db->where($wh);
  }
  $this->db->group_by('id_produk');
  $this->db->order_by('createddate', 'desc');

  return $this->db->get();
}

public function dataerups($wh=""){
  $this->db->select("tbl_erups.*, trx_produk.judul as produk");
  $this->db->from("tbl_erups");
  $this->db->join("trx_produk","trx_produk.id_produk=tbl_erups.id_produk","left");
  $this->db->join("trx_dana_invest","trx_dana_invest.id_produk=trx_produk.id_produk","left");
  if($wh!=""){
    $this->db->where($wh);
  }
  $this->db->group_by('tbl_erups.id');
  $this->db->order_by('tbl_erups.id', 'desc');

  return $this->db->get();
}

public function dataevote($wh=""){
  $this->db->select("tbl_vote.*, trx_produk.judul as produk");
  $this->db->from("tbl_vote");
  $this->db->join("trx_produk","trx_produk.id_produk=tbl_vote.id_produk","left");
  $this->db->join("trx_dana_invest","trx_dana_invest.id_produk=trx_produk.id_produk","left");
  if($wh!=""){
    $this->db->where($wh);
  }
  $this->db->group_by('tbl_vote.id');
  $this->db->order_by('tbl_vote.id', 'desc');

  return $this->db->get();
}


public function dataDanaShare($wh=""){
  $this->db->select("share.*, laporan.laba, laporan.rugi,   laporan.dividen ,share.createddate as tanggal, laporan.dokumen");
  $this->db->from("tbl_dana_laporan_share share");
  $this->db->join("tbl_dana_laporan laporan","laporan.id=share.id_laporan","left");
  if($wh!=""){
    $this->db->where($wh);
  }
		//$this->db->group_by('id_produk');
  $this->db->order_by('createddate', 'desc');

  return $this->db->get();
}

public function dataLaporanDanaHistory($wh="", $id=""){


  $query=array();
  $this->db->select("id_dana,'beli' as type,lembar_saham, jumlah_dana,createddate");
  $this->db->distinct();
  $this->db->from("trx_dana_invest invest");
  $this->db->where("id_produk",$id);
  if($wh!=""){
    $this->db->where($wh);
  }
  $this->db->group_by("invest.id_dana");
		//$this->db->order_by("createddate","desc");
		$query[]= $this->db->get_compiled_select(); // It resets the query just like a get()

		$this->db->select("id_jual,'jual' as type,lembar_saham,jumlah_dana,createddate");
		$this->db->distinct();
		$this->db->from("trx_dana_invest_jual");
		$this->db->where("id_produk",$id);
		if($wh!=""){
      $this->db->where($wh);
    }
		//$this->db->order_by("createddate","desc");
    $query[] = $this->db->get_compiled_select();

    $this->db->select("id_jual,'gadai' as type,lembar_saham,jumlah_dana,createddate");
    $this->db->distinct();
    $this->db->from("trx_dana_invest_gadai");
    $this->db->where("id_produk",$id);
    if($wh!=""){
      $this->db->where($wh);
    }
		//$this->db->order_by("createddate","desc");
    $query[] = $this->db->get_compiled_select();

    $this->db->select("id_refund,'refund' as type,lembar_saham,jumlah_dana,createddate");
    $this->db->distinct();
    $this->db->from("trx_dana_invest_refund");
    $this->db->where("id_produk",$id);
    if($wh!=""){
      $this->db->where($wh);
    }
		//$this->db->order_by("createddate","desc");
    $query[] = $this->db->get_compiled_select();


    $query = $this->db->query(implode(" UNION ",$query)." order by createddate asc");

    return $query;
  }


  public function dataDanaShareGadai($wh=""){
    $this->db->select("*");
    $this->db->from("trx_dana_invest_gadai");
    if($wh!=""){
      $this->db->where($wh);
    }
		//$this->db->group_by('id_produk');
    $this->db->order_by('createddate', 'desc');

    return $this->db->get();
  }

  public function dataDanaShareJual($wh=""){
    $this->db->select("*");
    $this->db->from("trx_dana_invest_jual");
    if($wh!=""){
      $this->db->where($wh);
    }
		//$this->db->group_by('id_produk');
    $this->db->order_by('createddate', 'desc');

    return $this->db->get();
  }


  public function dataDanaDtl($wh=""){

    $query=array();
    $this->db->select("id_pengguna,type_dana,jumlah_dana,status_approve,createddate");
    $this->db->distinct();
    $this->db->from("trx_dana");
    if($wh!=""){
      $this->db->where($wh);
    }
		//$this->db->order_by("createddate","desc");
		$query[]= $this->db->get_compiled_select(); // It resets the query just like a get()

		$this->db->select("id_pengguna,'invest' as type_dana,jumlah_dana,status_approve,id_produk,createddate");
		$this->db->distinct();
		$this->db->from("trx_dana_invest");
		if($wh!=""){
      $this->db->where($wh);
    }
		//$this->db->order_by("createddate","desc");
    $query[] = $this->db->get_compiled_select();

    $query = $this->db->query(implode(" UNION ",$query)." order by createddate desc");

    return $query;

  }

  public function dataDanaHistoryTransaksi($wh=""){

    $query=array();
    $this->db->select("id_dana, id_pengguna,type_dana,jumlah_dana,status_approve,createddate");
    $this->db->distinct();
    $this->db->from("trx_dana");
    if($wh!=""){
      $this->db->where($wh);
    }
		//$this->db->order_by("createddate","desc");
		$query[]= $this->db->get_compiled_select(); // It resets the query just like a get()

		$this->db->select("id_dana, id_pengguna,'investasi' as type_dana,jumlah_dana,status_approve,createddate");
		$this->db->distinct();
		$this->db->from("trx_dana_invest");
		if($wh!=""){
      $this->db->where($wh);
    }
		//$this->db->order_by("createddate","desc");
    $query[] = $this->db->get_compiled_select();

    $this->db->select("id_jual as id_dana, id_pengguna,'gadai' as type_dana,jumlah_dana,status_approve,createddate");
    $this->db->distinct();
    $this->db->from("trx_dana_invest_gadai");
    if($wh!=""){
      $this->db->where($wh);
    }
    $query[] = $this->db->get_compiled_select();

    $query = $this->db->query(implode(" UNION ",$query)." order by createddate desc");
    return $query;

  }

  public function dataDanaHistoryTransaksi2($wh=""){

    $query=array();
    $this->db->select("*");
		//$this->db->distinct();
    $this->db->from("trx_dana");
    if($wh!=""){
      $this->db->where($wh);
    }
    $this->db->order_by("createddate", "desc");
    return $this->db->get();

  }

  public function dataDanaHistoryTransaksiAdmin($wh=""){

    $query=array();
    $this->db->select("trx_dana.*, tbl_pengguna.nama_pengguna, tbl_admin.username,trx_produk.judul jdl,trx_dana_invest.lembar_saham lbr");
		//$this->db->distinct();
    $this->db->from("trx_dana");
    if($wh!=""){
      $this->db->where($wh);
    }
    $this->db->join("tbl_pengguna","tbl_pengguna.id_pengguna=trx_dana.id_pengguna","left");
    $this->db->join('tbl_admin', 'tbl_admin.id_admin=tbl_pengguna.id_admin', 'left');
    $this->db->join('trx_dana_invest', 'trx_dana_invest.id_dana=trx_dana.id_dana', 'left');
    $this->db->join('trx_produk', 'trx_produk.id_produk=trx_dana_invest.id_produk', 'left');
		// $this->db->where('trx_dana.type_dana="beli"');
		$this->db->order_by("trx_dana.id_dana", "desc"); //tbl_pengguna.createddate

		return $this->db->get();;

	}

  public function dataDanaHistoryTransaksiAdmin2($select="*", $wh = "", $wh2 = ""){
    $query=array();
    $this->db->select($select);
        //$this->db->distinct();
    $this->db->from("trx_dana");
    $this->db->join("tbl_pengguna","tbl_pengguna.id_pengguna=trx_dana.id_pengguna","left");
    $this->db->join('tbl_admin', 'tbl_admin.id_admin=tbl_pengguna.id_admin', 'left');
    $this->db->join('trx_dana_invest', 'trx_dana_invest.id_dana=trx_dana.id_dana', 'left');
    $this->db->join('trx_produk', 'trx_produk.id_produk=trx_dana_invest.id_produk', 'left');

    if ($wh['periode_from'] != "" && $wh['periode_until'] != "") {
      $this->db->where('trx_dana.createddate >= ', $wh['periode_from']);
      $this->db->where('trx_dana.createddate <= ', $wh['periode_until']);
    }

    if ($wh2 != "") {
      $this->db->where($wh2);
    }

        // $this->db->where('trx_dana.type_dana="beli"');
        $this->db->order_by("trx_dana.id_dana", "desc"); //tbl_pengguna.createddate

        return $this->db->get();

      }

      public function dataDanaHistory($wh=""){
        $this->db->select("sum(jumlah_dana) as total");
        $this->db->from("trx_dana");
        if($wh!=""){
          $this->db->where($wh);
        }
        $this->db->order_by('createddate', 'desc');
        return $this->db->get();
      }

      public function dataDana($wh=""){
        $this->db->select("*");
        $this->db->from("trx_dana_saldo");
        if($wh!=""){
          $this->db->where($wh);
        }
        return $this->db->get();
      }

      public function dataDanaCek($wh=""){
        $this->db->select("*");
        $this->db->from("trx_dana");
        if($wh!=""){
          $this->db->where($wh);
        }
        return $this->db->get();
      }


      public function dataDana2($wh=""){
        $this->db->select("a.*,coalesce(b.jumtambah,0) - coalesce(c.jumtarik,0) - coalesce(e.jumkembali,0) as jumlahdana, coalesce(b.jumtambah,0) as jumtambah, coalesce(c.jumtarik,0) as jumtarik, coalesce(d.jumpnr,0) as jumpnr, coalesce(i.juminvest,0) as juminvest  ");
        $this->db->from("trx_dana a");
        $this->db->join("(select id_pengguna, sum(jumlah_dana) as jumtambah from trx_dana where type_dana in ('tambah','promo','referral') and status_approve!='refuse' group by id_pengguna) b","b.id_pengguna=a.id_pengguna","left");
        $this->db->join("(select id_pengguna, sum(jumlah_dana) as juminvest from trx_dana_invest where status_approve!='refuse' group by id_pengguna) i","i.id_pengguna=a.id_pengguna","left");
        $this->db->join("(select id_pengguna, sum(jumlah_dana) as jumtarik from trx_dana where type_dana='tarik' and status_approve!='refuse' group by id_pengguna) c","c.id_pengguna=a.id_pengguna","left");
        $this->db->join("(select id_pengguna, sum(jumlah_dana) as jumpnr from trx_dana where type_dana in ('promo','referral') and status_approve!='refuse' group by id_pengguna) d","d.id_pengguna=a.id_pengguna","left");
        $this->db->join("(select p.id_pengguna, sum(d.jumlah_dana) as jumkembali from trx_produk p left join trx_dana d on d.id_produk=p.id_produk where d.type_dana='kembali' and d.status_approve!='refuse' group by p.id_pengguna) e","e.id_pengguna=a.id_pengguna","left");
        if($wh!=""){
          $this->db->where($wh);
        }
        return $this->db->get();
      }

      public function getJumDana(){
        $wh=array(
         "a.email"=>$this->session->userdata("invest_email"),
         "login_from"=>"web",
         "status"=>"aktif"
       );
        $jum_dana=0;
        $data=$this->checkUser($wh);
        if($data->num_rows()>0){
         $dt=$data->row();
         if($dt->id_pengguna>0 && $dt->bank>0){
          $whd=array("a.id_pengguna"=>$dt->id_pengguna,"a.id_bank"=>$dt->bank);
          $dana=$this->dataDana($whd);
          $jum_dana=$dana->num_rows()>0?$dana->row()->jumlahdana:0;
        }
      }
      return $jum_dana;
    }

    public function insertdata($table,$data){
      $this->db->insert($table, $data);
      return $this->db->insert_id();
    }

    public function insert($table,$data){
      $this->db->insert($table, $data);
      return $this->db->affected_rows() > 0;
    }

    public function insertbatch($table,$data){
      $this->db->insert_batch($table, $data);
      return $this->db->affected_rows() > 0;
    }


    public function updatedata($table,$data,$wh){
      $this->db->where($wh);
      $this->db->update($table, $data);
      return $this->db->affected_rows();
    }

    //dokumen
    public function dataDokumen($wh=""){
      $id_pengguna = $this->session->userdata("invest_pengguna");
      $this->db->select("d.*,b.ttd");
      $this->db->from("tbl_dokumen d");
      $this->db->join("tbl_pengguna b","b.id_pengguna=d.id_pengguna","left");
      if($wh!=""){
        $this->db->where($wh);
      }
      $result = $this->db->get();
      return $result->row();
    }

    //referral
    public function dataReferral($wh=""){
      $this->db->select("*");
      $this->db->from("tbl_pengguna");
      if($wh!=""){
        $this->db->where($wh);
      }
      $result = $this->db->get();
      return $result->row();
    }
/*
	public function listReferral($wh=""){
		$this->db->select("b.nama_pengguna, c.username, c.email, c.tipe");
        $this->db->from("tbl_referral a");
        $this->db->join("tbl_pengguna b","b.id_pengguna=a.id_pengguna","left");
        $this->db->join("tbl_admin c","b.id_admin=c.id_admin","left");
        if($wh!=""){
            $this->db->where($wh);
        }

        return $this->db->get();
	}
*/
  public function listReferral($wh=""){
    $this->db->select("
      b.id_pengguna AS id_user,
      b.nama_pengguna AS nama_investor,
      b.createddate AS tanggal_join,
      d.createddate AS tanggal_invest,
      d.jumlah_dana AS jumlah_invest,
      d.id_dana AS no_trx_invest,
      e.id_pengguna AS id_referral,
      e.nama_pengguna AS nama_referral,
      f.persen_komisi,
      e.kode_referral,
      g.status,
      g.keterangan,
      h.judul,
      d.id_produk
      ");
    $this->db->from("tbl_referral a");
    $this->db->join("tbl_pengguna b","b.id_pengguna=a.id_pengguna","left");
    $this->db->join("tbl_admin c","b.id_admin=c.id_admin","left");
    $this->db->join("trx_dana_invest d","d.id_pengguna=b.id_pengguna","left");
    $this->db->join("tbl_pengguna e","e.kode_referral=a.kode_referral","left");
    $this->db->join("tbl_komisi_referral f","f.id_produk=d.id_produk","left");
    $this->db->join("trx_dana_invest_komisi g","g.id_dana=d.id_dana AND g.id_pengguna = b.id_pengguna","left");
    $this->db->join("trx_produk h","h.id_produk=d.id_produk","left");
    if($wh != ""){
      $this->db->where($wh);
    }
        // $this->db->get();
        // var_dump($this->db->last_query());die();
    return $this->db->get();
  }

	 //pesan
  public function dataPesan($wh=""){
    $this->db->select("*,a.createddate AS msgcreateddate");
    $this->db->from("tbl_pesan a");
    $this->db->join("tbl_pengguna b","b.id_pengguna=a.id_pengguna","left");
    $this->db->order_by("a.createddate", "desc");
    if($wh!=""){
      $this->db->where($wh);
    }
    return $this->db->get();
  }


	//data pengguna
  public function dataPengguna($wh=""){
    $this->db->select("*");
    $this->db->from("tbl_pengguna");
    if($wh!=""){
      $this->db->where($wh);
    }
    $result = $this->db->get();
    return $result->row();
  }
  public function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
     $temp = " ". $huruf[$nilai];
   } else if ($nilai <20) {
     $temp = $this->penyebut($nilai - 10). " belas";
   } else if ($nilai < 100) {
     $temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
   } else if ($nilai < 200) {
     $temp = " seratus" . $this->penyebut($nilai - 100);
   } else if ($nilai < 1000) {
     $temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
   } else if ($nilai < 2000) {
     $temp = " seribu" . $this->penyebut($nilai - 1000);
   } else if ($nilai < 1000000) {
     $temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
   } else if ($nilai < 1000000000) {
     $temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
   } else if ($nilai < 1000000000000) {
     $temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
   } else if ($nilai < 1000000000000000) {
     $temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
   }
   return $temp;
 }

 public function penyebut2($nilai) {
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 1000000) {
   $temp = ($nilai/1000) . " Rb" ;
 } else if ($nilai < 1000000000) {
   $temp = $nilai/1000000 . " Jt" ;
 } else if ($nilai < 1000000000000) {
   $temp = ($nilai/1000000000) . " M" ;
 } else if ($nilai < 1000000000000000) {
   $temp = ($nilai/1000000000000) . " T" ;
 }
 return $temp;
}

public function terbilang($nilai) {
  if($nilai<0) {
   $hasil = "minus ". trim($this->penyebut($nilai));
 } else {
   $hasil = trim($this->penyebut($nilai));
 }
 $hasil = number_format($nilai,0,".",".");
 return $hasil;
}
public function checkRole(){
 $role="";
 if($this->session->userdata("invest_username")!="" && $this->session->userdata("invest_email")!=""){
   $role=$this->session->userdata("invest_tipe");
 } else {
   $role="user";
 }
 return $role;
}

public function getToc()
{
  return $this->db->order_by('mulai_berlaku', 'DESC')->limit(1)->get_where('tbl_toc', array('is_aktif' => 1))->row();
}

public function getProdukById($id_produk)
{
  return $this->db->where('trx_produk', array('id_produk' => $id_produk))->row();
}

public function getPortfolioPasarSekunder($filter = ""){
  $this->db->select("ps.*, p.judul");
  $this->db->from("trx_pasar_sekunder ps");
  $this->db->join("trx_produk p","p.id_produk = ps.id_produk","left");

  if($filter != ""){
    $this->db->where($filter);
  }

  $this->db->where('deleted_at IS NULL', null);

    // $this->db->group_by('id_produk');
  $this->db->order_by('created_at', 'desc');

  return $this->db->get();
}

public function setPortfolioPasarSekunder($data, $filter = []){
  if (!empty($filter)) {
    $query = $this->db->update('trx_pasar_sekunder', $data, $filter);
    return $query ? $this->db->affected_rows() : 0;
  } else {
    $query = $this->db->insert('trx_pasar_sekunder', $data);
    return $query ? $this->db->insert_id() : 0;
  }
}

}
?>
