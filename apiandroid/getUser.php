<?php

//	if(isset($_POST['searchQuery']))
//	{
     	  require_once('koneksi.php');
		   $search_query=$_POST['searchQuery'];
       //  $search_query='kamis@gmail.com';
         $sql =  "SELECT * FROM t_user WHERE email LIKE '%".$search_query."%'";
     //     $sql = 'SELECT value, param FROM db_jayamart WHERE nama_produk = :search_query';
        // $sql = "SELECT * FROM t_data_pinjaman WHERE title LIKE ':search_query'";
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
//	}
		  
?>
