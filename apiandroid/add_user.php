<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
require_once ('config.php');

 $id = $_POST['id'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $nama_user = $_POST['nama_user'];
 $preferensi1 = $_POST['preferensi1'];
 $preferensi2 = $_POST['preferensi2'];
 $jenis_kelamin = $_POST['jenis_kelamin'];
 $tempat_lahir = $_POST['tempat_lahir'];
 $tanggal_lahir = $_POST['tanggal_lahir'];
 $status_perkawinan = $_POST['status_perkawinan'];
 $agama = $_POST['agama'];
 $pendidikan = $_POST['pendidikan'];
 $pekerjaan = $_POST['pekerjaan'];
 $no_ktp = $_POST['no_ktp'];
 $alamat_ktp = $_POST['alamat_ktp'];
 $negara_ktp = $_POST['negara'];
 $no_hp = $_POST['no_hp'];
 $no_alternatif = $_POST['no_alternatif'];
 $alamat_domisili = $_POST['alamat_domisili'];
 $negara_domisili = $_POST['negara2'];
 $alamat_surat = $_POST['alamat_surat'];
 $provinsi_ktp = $_POST['provinsi_ktp'];
 $kab_kota_ktp = $_POST['kab_kota_ktp'];
 $provinsi_domisili = $_POST['provinsi_domisili'];
 $kab_kota_domisili = $_POST['kab_kota_domisili'];
 $nama_pemegang_akun_bank = $_POST['nama_pemegang_akun'];
 $nomor_rekening = $_POST['nomor_rekening'];
 $nama_bank = $_POST['nama_bank'];
 
 
 $image = $_POST['image_url'];
		
	//$foto = $_FILES['file']['name'];
		
		$path = "investpro/image/user_ttd/";
		
		$actualpath = "http://deeeprcode.online/investpro/image/user_ttd/$nama_bank";
		
	//	$sql = "INSERT INTO t_image_ttd VALUES ('1','$actualpath')";
		
 
$query = "INSERT INTO t_user VALUES ('$id','$email','$password','$nama_user','$preferensi1','$preferensi2','$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$status_perkawinan', '$agama', '$pendidikan',
'$pekerjaan', '$no_ktp', '$alamat_ktp', '$negara_ktp', '$no_hp', '$no_alternatif', '$alamat_domisili', '$negara_domisili', '$alamat_surat', '$provinsi_ktp', '$kab_kota_ktp',
'$provinsi_domisili', '$kab_kota_domisili', '$nama_pemegang_akun_bank', '$nomor_rekening', '$nama_bank', 'Menunggu Verifikasi')";

$sql = mysqli_query($connection, $query);
$ray = array();

while ($row = mysqli_fetch_array($sql)){
$ray[] = $row;
}
file_put_contents($path,base64_decode($nama_bank));
echo 'Data Submit Successfully';


}else {
$ray = array(
"status" => "false",
"message" => "Bad Request");
echo 'Try Again';

}


?>