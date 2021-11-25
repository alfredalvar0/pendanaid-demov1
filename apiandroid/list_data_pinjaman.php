
<?php

	if(isset($_POST['searchQuery']))
	{
     	  require_once('koneksi.php');
		//  $search_query=$_POST['searchQuery'];
		// $search_query='p';
          $sql =  "SELECT * FROM trx_produk ORDER BY createddate ASC ";
     //     $sql = 'SELECT value, param FROM db_jayamart WHERE nama_produk = :search_query';
        // $sql = "SELECT * FROM t_data_pinjaman WHERE title LIKE ':search_query'";
        
        //fix_jumlah_investor
        //   $sql2 = "SELECT COUNT(*) as investor FROM trx_dana_invest where id_produk = $search_query";
          
          
          //jumlah_terkumpul 
          //  $sql3 = "SELECT SUM(jumlah_dana) as dana FROM trx_dana_invest where id_produk = $search_query";
           
         
        
          $statement = $connection->prepare($sql);
		  $statement->bindParam(':search_query', $search_query, PDO::PARAM_STR);
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
	}
		  
?>