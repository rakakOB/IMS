<?php
		include "../connection.php";
		$pn=$_POST['Pol'];
		$pay=$_POST['pay'];
		$nn = 0;
		$insta ;
		$sql3 = "select * from policy_data where Policy_Num = '$pn'";    
		$result3 = mysqli_query($conn,$sql3); 
		$row3 = mysqli_fetch_object($result3);
		
		if($pay=='Yes'){
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
			
			/*	$insta	also here.*/																								
			$sql1="select * from premium where Policy_Num = '$pn'";
			$result1 = mysqli_query($conn,$sql1);
			$row1 = mysqli_fetch_object($result1);

					if ($row1->Mode=='MLY'){
						$nd = "$row1->Last_date";
						$ld = date('Y-m-d', strtotime($nd. ' + 1 months'));
						//$ld = date('Y-m-d', strtotime($d. ' + 1 months'));
						global $insta;
						$insta = $row3->Pay_Period*12;
					}
					else if ($row1->Mode=='QLY'){
						$nd = "$row1->Last_date";
						$ld = date('Y-m-d', strtotime($nd. ' + 3 months'));
						//$ld = date('Y-m-d', strtotime($d. ' + 3 months'));
												global $insta;
												$insta = $row3->Pay_Period*4;
					}
					else if ($row1->Mode=='YLY'){
						$nd = "$row1->Last_date";
						$ld = date('Y-m-d', strtotime($nd. ' + 1 years'));
						//$ld = date('Y-m-d', strtotime($d. ' +  1 years'));
												global $insta;
												$insta = $row3->Pay_Period*1;
					}
					else  {
						$ld = 0;
						global $insta;
						$insta = 1;
  					}
				
			
			$query2="update premium set last_date= '$ld' where Policy_Num='$pn'";
			mysqli_query($conn,$query2) or die($query2."Can't Connect to Query...");
			$query3="update unpaid_premium set Fine=0,Lateness=0 where Policy_Num='$pn' ";
			mysqli_query($conn,$query3) or die($query3."Can't Connect to Query...");
		//here clearing
		
		if ($insta - $nn == 0){
			$queryn= "DELETE FROM unpaid_premium WHERE Policy_Num='$pn'";
			mysqli_query($conn,$queryn) or die($query2."Can't Connect to Query...");
		}
		//		
		
		}
		else if($pay=='No'){
			$now = time();
			$sql1 = "select * from unpaid_premium";
			$result1 = mysqli_query($conn,$sql1); 
			
						while($row1 = mysqli_fetch_object($result1)){
			$sql2 = "select * from premium";
			$result2 = mysqli_query($conn,$sql2); 
			while($row2 = mysqli_fetch_object($result2)){
						if($row2->Policy_Num==$row1->Policy_Num)
							$ld = "$row2->Last_date";
				}
						}
			$your_date = strtotime($ld);
			if($now>$your_date)
			{
			$datediff = $now - $your_date;
			$late= round($datediff / (60 * 60 * 24));
			$f=$late*5000;
			$query3="update unpaid_premium set Fine='$f',Lateness='$late' where Policy_Num='$pn' ";
			mysqli_query($conn,$query3) or die($query3."Can't Connect to Query...");
			}
			else {
				
			$query3="update unpaid_premium set Fine=-1,Lateness=-1 where Policy_Num='$pn' ";
			mysqli_query($conn,$query3) or die($query3."Can't Connect to Query...");
			}
		}
		
?>