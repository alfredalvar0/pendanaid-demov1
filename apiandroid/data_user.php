<?php

	if(isset($_POST['searchQuery']))
	{
     	  require_once('koneksi.php');
		  $search_query=$_POST['searchQuery'];
          $sql = 'SELECT * FROM t_user WHERE id = :search_query';
     //   $sql = 'SELECT * FROM t_data_pinjaman WHERE title = :search_query';
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
