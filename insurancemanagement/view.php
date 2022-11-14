<?php
include "connection.php";
if(is_numeric($_GET['Policy_Num'])){    
$sql = "select * from policy_data where Policy_Num = '".$_GET['Policy_Num']."'";    
$result = mysqli_query($conn,$sql); 
$row = mysqli_fetch_object($result);
$sql1 = "select * from customer where Customer_Num = $row->Customer_Num";    
$result1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_object($result1);
$sql2 = "select * from agent where Agent_code = '$row->Agent_code'";    
$result2 = mysqli_query($conn,$sql2);
$row2 = mysqli_fetch_object($result2);
$sql3 = "select * from premium where Policy_Num = $row->Policy_Num";    
$result3 = mysqli_query($conn,$sql3);
$row3 = mysqli_fetch_object($result3);
}

?>
<html>    
    <head>    
        <title>Policy Information</title>  
		<link href = "regi.css" type = "text/css" rel = "stylesheet" />  
    </head>    
    <body>    
        <link href = "regi.css" type = "text/css" rel = "stylesheet" />
		<ul>
			<li><a href="policy/modified1.php"> Back to Policy datas</a></li>
			<li style="float:right;"><a href="default.php"> Back to homepage</a></li>
		</ul>
		<center>
		<h1> Policy Data </h1>
		
		<!-- width = "50%" border="1" cellspacing = "1" cellpadding = "3" align="center"  -->
        <table width = "90%" height = "80%" border="0" cellspacing = "1" cellpadding = "3" align="center">
            <tr valign = "top" align = "center">
                <td>Policy Number:   <br><?php echo "$row->Policy_Num";?></td>
				<td>Agent Code:      <br><?php echo "$row2->Agent_code";?></td>
                <td>Customer Number: <br><?php echo "$row1->Customer_Num";?></td>
				<td>Customer Name:   <br><?php echo "$row1->First_Name $row1->Middle_Name $row1->Last_Name"; ?>				
			</tr>
			<!-- DOC Product Sum_Assured Pay_Period Ins_Period -->
				<tr valign = "top" align = "center">
					<td>DOC: 			<br><?php echo "$row->DOC";?></td>
					<td>Product: 		<br><?php echo "$row->Product";?></td>
					<td>Sum Assured: 	<br><?php echo "$row->Sum_Assured";?> Rs.</td>
					<td>Payment Period: <br><?php echo "$row->Pay_Period";?> Yrs.</td>
					<td>Insurance Period: <br><?php echo "$row->Ins_Period";?> Yrs.</td>
				</tr>
			<tr valign = "top" align = "center">
				<td>Marital Status: <br><?php if($row1->Marital_status=='M'){echo "Married";} else{echo "UnMarried";}?></td>
				<td>Spouse: 	<br><?php echo "$row1->Spouse";?></td>
				<td style = "color: red;">NO. of installments: <br><?php if($row3->Mode=='MLY'){echo $row->Pay_Period*12;} 
												else if ($row3->Mode=='QLY')  {echo $row->Pay_Period*4;}
												else if ($row3->Mode=='YLY')  {echo $row->Pay_Period*1;}
												else {echo 1;} ?> <td>
								

			</tr>
			<tr valign = "top" align = "center">
				<td>Address: 	<br><?php echo "$row1->Address";?></td>
				<td>PIN: 		<br><?php echo "$row1->Pincode";?>
				<td>Contact: 	<br><?php echo "$row1->Contact_Number";?></td>
			</tr>
			<tr valign = "top" align = "center">
				<td>Mother: <br><?php echo "$row1->Mother_Name";?>[<?php if($row1->Mother_Status=='D'){echo "Dead";} else{echo "Alive";}?>]</td>
				<td>Father: <br><?php echo "$row1->Father_Name";?>[<?php if($row1->Father_Status=='D'){echo "Dead";} else{echo "Alive";}?>]</td>
				</tr>
			</table>
		</center>
    </body>    
</html>