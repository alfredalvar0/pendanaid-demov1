


<?php

//	if(isset($_POST['searchQuery']))
//	{
     	  require_once('koneksi.php');
		//  $search_query=$_POST['searchQuery'];
		// $search_query='p';
          $sql =  "SELECT 
'a'.*, coalesce(b.jumtambah, 0) + coalesce(b.jumkembali, 0) - coalesce(c.jumtarik, 0) - coalesce(i.juminvest, 0) as jumlahdana, 
coalesce(b.jumtambah, 0) as jumtambah, 
coalesce(c.jumtarik, 0) as jumtarik, 
coalesce(d.jumpnr, 0) as jumpnr, 
coalesce(i.juminvest, 0) as juminvest 
FROM 'trx_dana' 'a' 
LEFT JOIN 
(select id_pengguna, sum(jumlah_dana) as jumtambah from trx_dana where type_dana in ('tambah','promo','referral') and status_approve!='refuse' group by id_pengguna) b 
ON 'b'.'id_pengguna'='a'.'id_pengguna' 
LEFT JOIN 
(select id_pengguna, sum(jumlah_dana) as juminvest from trx_dana_invest where status_approve!='refuse' group by id_pengguna) i 
ON 'i'.'id_pengguna'='a'.'id_pengguna' 
LEFT JOIN 
(select id_pengguna, sum(jumlah_dana) as jumtarik from trx_dana where type_dana='tarik' and status_approve!='refuse' group by id_pengguna) c 
ON 'c'.'id_pengguna'='a'.'id_pengguna' 
LEFT JOIN 
(select id_pengguna, sum(jumlah_dana) as jumpnr from trx_dana where type_dana in ('promo','referral') and status_approve!='refuse' group by id_pengguna) d 
ON 'd'.'id_pengguna'='a'.'id_pengguna' 
LEFT JOIN 
(select id_pengguna, sum(jumlah_kembali) as jumkembali from trx_dana where type_dana='kembali' and status_approve!='refuse' group by id_pengguna) e 
ON 'e'.'id_pengguna'='e'.'id_pengguna' 
WHERE 'a'.'id_pengguna' = '1'";
         
        
          $statement = $connection->prepare($sql);
		 // $statement->bindParam(':search_query', $search_query, PDO::PARAM_STR);
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