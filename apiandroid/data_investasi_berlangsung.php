<?php

	
     	  require_once('koneksi.php');
		  $search_query=$_POST['searchQuery'];
	//	  $id_produk=$_POST['id_produk'];
		  //SELECT * FROM trx_produl LEFT JOIN trx_dana_invest ON trx_produk.id_produk = '2' WHERE trx_dana_invest.id_pengguna = '2';
         //   $sql = 'SELECT * FROM t_data_investasi WHERE id_user = :search_query AND id_pinjaman_data = :id_produk';
            // $sql = "SELECT * FROM trx_dana_invest LEFT JOIN trx_produk ON trx_produk.id_produk = '25' WHERE trx_dana_invest.id_pengguna = '1' AND trx_dana_invest.status_approve = 'pending'";
        $sql = "SELECT
a.jumlah_dana as invested,
b.bagi_hasil,b.frekuensi_angsuran,b.tglakhir,b.judul,b.id_produk,
(a.jumlah_dana+((a.jumlah_dana*b.bagi_hasil)/100)) as pengembalian
FROM 
trx_dana_invest a
LEFT JOIN 
trx_produk b ON a.id_produk=b.id_produk
WHERE a.status_approve ='approve' 
and a.id_pengguna=$search_query";
          $statement = $connection->prepare($sql);
		 // $statement->bindParam(':search_query', $search_query, PDO::PARAM_STR);
		 // $statement->bindParam(':id_produk', $id_produk, PDO::PARAM_STR);
          $statement->execute();
          if($statement->rowCount())
          {
				$row_all = $statement->fetchall(PDO::FETCH_ASSOC);
   		  	 print(json_encode($row_all));
          		
          }  
          elseif(!$statement->rowCount())
          {
			  echo "no rows";
          }
	
		  
?>