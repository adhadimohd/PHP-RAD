<?php
session_start();
include "functions.php";
include "includes/config.php";

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
		 
		 <!-- Begin Left Column -->
		 <div id="leftcolumn">
		      <?php
	
				
			  if (isset($_SESSION['appId']))
					{
						// do something
						$db = $_SESSION['database'];
						
					
						showtables($db);
						
					
						
						}
					else
					{
						//showdatabases();
				}
			  
			  ?>
              
         
		 </div>
		 <!-- End Left Column -->
		 
		 <!-- Begin Right Column -->
		 <div id="rightcolumn">
       
         <?php
		 
		  if (isset($_SESSION['database']))
			{
				// do something
				$db = $_SESSION['database'];
				
				if (isset($_GET['table']))
				{
					$table = $_GET['table'];
					showcolumns($db, $table);
					
					}
					
				if (isset($_GET['do']))
				{
					
					if ($_GET['do']=="generate")
					{
						$aId = $_SESSION['appId'];
						DoCodeGenerate ($aId,$db);
						
						}
				}
			}
		 ?>
         
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
