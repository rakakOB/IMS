<?php
		include "connection.php";
		$pn=123123123;
		$nn = 0;
		$h = 'jelkwqjeklq';
		
		echo $h.'<br>';

			$d=date("Y-m-d");
			$r=time()%(100000000000);
			$query="insert into paid_premium(Receipt_Num,Receipt_Date,Policy_Num) values('$r','$d','$pn')";
			mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
			//here , finding no of premiums paid for policy .so that to find diffof insta&pp ie remaining installments .
					$sql10 = "select * from paid_premium";
					$result10 = mysqli_query($conn,$sql10);    
					while($row10 = mysqli_fetch_object($result10)){
						if($row10->Policy_Num==$pn)
							$nn = $nn +1;
					}
			//end here
		echo $nn.'<br>';
			$sql1="select * from premium where Policy_Num = '$pn'";
			$result1 = mysqli_query($conn,$sql1);
			$row1 = mysqli_fetch_object($result1);

			/*	//getting installments
					$sql12 = "select * from policy_data";    
					$result12 = mysqli_query($conn,$sql12);   
					while($row12 = mysqli_fetch_object($result12)){
						if($row12->Policy_Num==$pn)
						{
												if($row1->Mode=='MLY'){$insta = $row12->Pay_Period*12;} 
												else if ($row1->Mode=='QLY')  {$insta = $row12->Pay_Period*4;}
												else if ($row1->Mode=='YLY')  {$insta = $row12->Pay_Period*1;}
												else {$insta = 1;} 
						}
					}
				//end here ,got it $insta.		*/
				
					
					if ($row1->Mode=='MLY'){
						$nd = "$row1->Last_date";
						$ld = date('Y-m-d', strtotime($nd. ' + 1 months'));
						//$ld = date('Y-m-d', strtotime($d. ' + 1 months'));
		echo $ld.'<br>';
					}
					else if ($row1->Mode=='QLY'){
						$nd = "$row1->Last_date";
						$ld = date('Y-m-d', strtotime($nd. ' + 3 months'));
						//$ld = date('Y-m-d', strtotime($d. ' + 3 months'));
		echo $ld.'<br>';

					}
					else if ($row1->Mode=='YLY'){
						$nd = "$row1->Last_date";
						$ld = date('Y-m-d', strtotime($nd. ' + 1 years'));
						//$ld = date('Y-m-d', strtotime($d. ' +  1 years'));
		echo $ld.'<br>';
					}
					else  {
						$ld = 0;								echo $ld.'<br>';


  					}
				
		echo $ld.'<br>';
		echo $h.'<br>';

	/*	//here clearing
		
		if ($insta - $nn == 0){
			$queryn= "DELETE FROM unpaid_premium WHERE Policy_Num='$pn'";
			mysqli_query($conn,$queryn) or die($query2."Can't Connect to Query...");
		}
		//		*/
		
		$query2="update premium set last_date= '$ld' where Policy_Num='$pn'";
			mysqli_query($conn,$query2) or die($query2."Can't Connect to Query...");
			$query3="update unpaid_premium set Fine='$nn',Lateness=0 where Policy_Num='$pn' ";
			mysqli_query($conn,$query3) or die($query3."Can't Connect to Query...");
		
		
?>