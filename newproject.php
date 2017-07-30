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
         
         <h2>Create Project</h2>
         <form name="createproject" action="createproject.php" method="post">
         <p>
         <label class=project>Project Name </label><br />
         <input type="text" name="f_ProjectName" />
         </p>
         
         <p>
         <label class=project>Database </label><br />
         <select name="f_Database">
         <?php echo listdatabases("option"); ?>
         </select>
         </p>
         
         
         
         <br />
         <p>
         <label class=project>Application Template </label><br />
         <select name="f_ApplicationTemplate">
         <?php
		$folders=folderlist("templates/");
		
		foreach ($folders as $folder) {
			$f = $folder['name'];
			
				echo "<option value=\"$f\">$f</option>";
			
		}
		 
		 ?>
         </select>
         </p>
         
         
         <p>
         <input type="submit" name="submit" value="Create" />
         </p>
         
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
