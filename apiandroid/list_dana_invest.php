<?php

//	if(isset($_POST['searchQuery']))
//	{
     	  require_once('koneksi.php');
		  $search_query=$_POST['searchQuery'];
		 // $search_query='25';
		  
           //$sql = "SELECT count(*) as jumlah_dana FROM trx_dana_invest WHERE status_approve='pending' AND id_produk = $search_query";
          // $sql = "SELECT count(*) as a FROM trx_dana_invest WHERE status_approve='pending' AND id_produk = $search_query";
          
          //fix_jumlah_investor
           $sql = "SELECT COUNT(*) as investor FROM trx_dana_invest where id_produk = $search_query and status_approve = 'approve'";
          
          
          //jumlah_terkumpul 
            $sql2 = "SELECT SUM(jumlah_dana) as dana FROM trx_dana_invest where id_produk = $search_query and status_approve = 'approve'";
           
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
