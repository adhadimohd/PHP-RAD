<?php
include "functions.php";

define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_HOST", "localhost");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RAD Tools 1.0</title>
<link rel="stylesheet" type="text/css" href="nav.css"/>
<link rel="stylesheet" type="text/css" href="style2.css"/>
</head>

<body>

   <!-- Begin Wrapper -->
   <div id="wrapper">
   
         <!-- Begin Header -->
         <div id="header">
		 
		      <H1>RAD TOOLS	</H1>
              
		 <?php include "nav.php" ?>

	   
		 </div>
		 <!-- End Header -->

		 
		 <!-- Begin Right Column -->
		 <div id="fullcolumn">
         
         <h2>Load Project</h2>
         <form name="createproject" action="createproject.php" method="post">
         <p>
        Project Name <br />
         </p>
         
<table id="listview" cellspacing="0" summary="Data Listing">
<caption>List of data in table project</caption>
<thead>
<tr>
<th scope="col" class="nobg" >Action</th><th scope="col">ProjectName</th><th scope="col">DatabaseName</th><th scope="col">ApplicationTemplate</th>
</tr>
</thead>
<tbody>
<?php
	
	 	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, "radtools");
		/* check connection */
	
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query= "SELECT * FROM project";
		//echo $query;
		if ($result = $mysqli->query($query) )
			{
		 while ($row = $result->fetch_assoc()) { ?>
		 <tr onClick="window.location.href='loader.php?do=load&id=<?php echo $row['id']?>';">
       		<th scope="row" class="spec"><a href='loader.php?do=load&id=<?php echo $row['id']?>'><?php echo $row['id']; ?></th>
<td><?php echo $row['ProjectName']; ?></td>
<td><?php echo $row['DatabaseName']; ?></td>
<td><?php echo $row['ApplicationTemplate']; ?></td>

		</tr>
    	<?php 
			}
		}

    	/* free result set */
    	$result->free();

?>
</tbody>
</table>
         
         
</form>
       
       
         </div>
		 <!-- End Right Column -->
		 
		 <!-- Begin Footer -->
		 <div id="footer">
		       
			   Copyright Reserved AdhadiMohd Resources		
			    
	     </div>
		 <!-- End Footer -->
		 
   </div>
   <!-- End Wrapper -->
   
</body>
</html>
