<?php    
    
include "../connection.php";    
    
$sql = "select * from policy_data";    
$result = mysqli_query($conn,$sql); 

?>    
<html>    
    <body>      
		<link href = "../regi.css" type = "text/css" rel = "stylesheet" /> 
		
		<ul>
			<li style="float:right;"><a href="../default.php"> Back to homepage</a></li>
		</ul>
		<br>
		<h1><center>Policy Data</center></h1>
	
		<table width = "100%" border = "10" cellspacing = "3" cellpadding = "3">    
		<tr>    
                <td>Policy Number</td>    
                <td>Customer Number</td>    
                <td>Agent code</td>    
                <td>DOC</td>    
                <td>Product</td>    
                <td>Total Sum.</td>    
                <td>Payment Period</td>    
                <td style = "color : red;" >insurance period</td>  
				<td>MODE</td>
				<td>Policy info</td>
                <td colspan = "2">Action</td>    
            </tr>  
	<?php    
    
		while($row = mysqli_fetch_object($result)){    
    
    
	?>  
			<tr>  
				<td>  
					<?php echo $row->Policy_Num;?>  
				</td>  
				<td>  
					<?php echo $row->Customer_Num;?>  
				</td>  
				<td>  
					<?php echo $row->Agent_code;?>  
				</td>  
				<td>  
					<?php echo $row->DOC;?>  
				</td>  
				<td>  
					<?php echo $row->Product;?>  
				</td>  
				<td>  
					<?php echo $row->Sum_Assured;?>  
				</td>  
				<td>  
					<?php echo $row->Pay_Period;?>  
				</td>  
				<td>  
					<?php 
								$fin = date('Y-m-d', strtotime($row->DOC. ' +  '.$row->Ins_Period.' years'));
					echo $row->Ins_Period." years<br>ie.Ends:<br>".$fin; ?>  
				</td> 
				<td>  
				<?php
					$sql2 = "select * from premium";
					$result2 = mysqli_query($conn,$sql2);    
					while($row2 = mysqli_fetch_object($result2)){
						if($row2->Policy_Num==$row->Policy_Num)
							echo $row2->Mode;
					}	
					?>				
					</td>	
				<td>  
					<a href="../view.php ? Policy_Num=<?php echo $row->Policy_Num;?>">Policy Data </a>
				</td>
				<td> 
				<a href="delete.php ? pol=<?php echo $row->Policy_Num;?>" onclick="return confirm('Are You Sure')">Delete  </a>
				</td>  
			</tr>  
		<?php } ?>  			
        </table>  
<!-- --> 		
    </body>    
</html>