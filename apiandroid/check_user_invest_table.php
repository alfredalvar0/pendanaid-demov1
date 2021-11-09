<?php

	
     	  require_once('koneksi.php');
		  $search_query=$_POST['searchQuery'];
		  $id_produk=$_POST['id_produk'];
            $sql = "SELECT * FROM trx_dana_invest WHERE id_pengguna = :search_query AND id_produk = :id_produk AND status_approve = 'approve'";
     //   $sql = 'SELECT * FROM t_data_pinjaman WHERE title = :search_query';
          $statement = $connection->prepare($sql);
		  $statement->bindParam(':search_query', $search_query, PDO::PARAM_STR);
		  $statement->bindParam(':id_produk', $id_produk, PDO::PARAM_STR);
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