<html>    
    <head>    
        <title>Payment Form</title>    
    </head>    
    <body>    
        <link href = "../regi.css" type = "text/css" rel = "stylesheet" />

		<ul>
			<li style="float:right;"><a href="../default.php"> Back to homepage</a></li>
		</ul>
		<br>		
        <h2>Premium</h2>    
		
        <form name = "form1" action='view.php' method = 'POST' enctype = "multipart/form-data" >    
			<div class = "container">
				<div class = "form_group">    
                    <label>Policy Number:</label>    
                    <input type = "text" name = "pol" value = "" required pattern="[0-9]{9}" />
					<h6><label>Enter 9 digit number</label></h6>
                </div>
				</div>
				<hr>
                <div class = "form_group">    
                    <input type = "submit" value = "submit"/>    
                   
                    <input type = "reset" value = "reset"/>    
                </div>
				 
            </div>    
        </form>   
<!-- -->		
    </body>    
</html>    