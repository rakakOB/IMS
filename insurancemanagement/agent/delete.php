<?php
include "../connection.php";  
  
if(isset($_GET['id'])) {    
$sql = "delete from agent where Agent_code = '".$_GET['id']."'";    
$result = mysqli_query($conn,$sql);    
}
//$result= "not req.
header('Location:modified1.php');
?>