

<?php

require_once ('koneksi2.php');

//$search_query=$_POST['searchQuery'];
$query = "SELECT
p.id_produk, p.judul,p.jumlah_investasi,p.slot, p.deskripsi, p.tenor, p.bagi_hasil, p.agunan, p.pengembalian_pokok, p.frekuensi_angsuran,
concat('https://investpro.mynimstudio.id/assets/img/produk/',p.foto) as foto,
p.tglakhir,
p.status_approve as stsapprove_produk,
coalesce(i.invested,0) as invested,
i.status_approve,coalesce(i.terkumpul,0) as terkumpul,
((i.terkumpul*100)/p.jumlah_investasi) as persenterkumpul,
DATEDIFF(p.tglakhir, now()) as sisa_hari
FROM trx_produk p
LEFT JOIN 
(
SELECT 
id_produk, status_approve,COUNT(*) as invested,SUM(jumlah_dana) as terkumpul 
FROM trx_dana_invest 
WHERE status_approve='approve' 
GROUP BY id_produk
) i 
ON i.id_produk=p.id_produk
WHERE p.status_approve='approve' ORDER BY jumlah_investasi ASC";

$sql = mysqli_query($con, $query);
$ray = array();

while ($row = mysqli_fetch_array($sql)){
$ray[] = $row;
}
echo json_encode($ray);




?>