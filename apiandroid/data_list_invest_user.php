
<?php

//	if(isset($_POST['searchQuery']))
//	{
     	  require_once('koneksi.php');
		  $search_query=1;
		  $search_query2=7;
          $sql =  "SELECT * FROM t_data_pinjaman WHERE id LIKE '%".$search_query."%'";
          $sql2 =  "SELECT * FROM t_data_investasi_user WHERE id_user LIKE '%".$search_query2."%'";
     //     $sql = 'SELECT value, param FROM db_jayamart WHERE nama_produk = :search_query';
        // $sql = "SELECT * FROM t_data_pinjaman WHERE title LIKE ':search_query'";
          $statement = $connection->prepare($sql);
          $statement2 = $connection->prepare($sql2);
          $statement->execute();
          $statement2->execute();
          if($statement->rowCount())
          {
				$row_all = $statement->fetchall(PDO::FETCH_ASSOC);
   		  	 print(json_encode($row_all));
          		
          }  
          elseif(!$statement->rowCount())
          {
			  echo "no rows";
          }
          if($statement2->rowCount())
          {
				$row_all = $statement2->fetchall(PDO::FETCH_ASSOC);
   		  	 print(json_encode($row_all));
          		
          }  
          elseif(!$statement2->rowCount())
          {
			  echo "no rows";
          }
//	}
		  
?>