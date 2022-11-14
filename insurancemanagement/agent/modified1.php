<?php    
include "../connection.php";
    
    
$sql = "select * from agent";    
$result = mysqli_query($conn,$sql);    
?>    
<html>    
    <body>    
	    <link href = "../regi.css" type = "text/css" rel = "stylesheet" /> 
		<ul>
			<li style="float:right;"><a href="../default.php"> Back to homepage</a></li>
		</ul>		
		<br>
		<h1><center>Agents Data</center></h1>
		
		<table width = "100%" border = "10" cellspacing = "3" cellpadding = "3">    
            <tr>    
                <td>Agent Code</td>    
                <td>Agent Name</td>    
                <td>DOB</td>    
                <td>Address</td>    
                <td>Pincode</td>    
                <td>Branch</td>    
				<td>Contact Number</td>
                <td colspan = "2">Action</td>    
            </tr>  
	<?php    
    
		while($row = mysqli_fetch_object($result)){    
    
    
	?>  
			<tr>  
				<td>  
					<?php echo $row->Agent_code;?>  
				</td>  
				<td>  
					<?php echo $row->Agent_name;?>  
				</td>  
				<td>  
					<?php echo $row->DOB;?>  
				</td>  
				<td>  
					<?php echo $row->Address;?>  
				</td>  
				<td>  
					<?php echo $row->Pincode;?>  
				</td>  
				<td>  
					<?php echo $row->Branch;?>  
				</td>  
				<td> 
					<?php echo $row->Contact_Num;?>  
				</td>  
				<td> 
				<a href="delete.php ? id=<?php echo $row->Agent_code;?>" onclick="return confirm('Are You Sure')">Delete    
				</a>
				</td>  
			</tr>  
		<?php } ?>  			
        </table>   		
    </body>    
</html>