<?php
require_once "includes/config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rapid Web Developer 1.0</title>
<style>
ul#minitabs{list-style: none;margin: 0;padding: 7px 0;
  border-bottom: 1px solid #CCC;font-weight: bold;
  text-align: center;white-space: nowrap}
ul#minitabs li{display: inline;margin: 0 3px}
ul#minitabs a{text-decoration: none;padding: 0 0 3px;
  border-bottom: 4px solid #FFF;color: #999}
ul#minitabs a#current{border-color: #F60;color:#06F}
ul#minitabs a:hover{border-color: #F60;color: #666}

#menu8 {
	width: 200px;
	margin-top: 10px;
}
	
#menu8 li a {
	text-decoration: none;
	height: 32px;
  	voice-family: "\"}\""; 
  	voice-family: inherit;
  	height: 24px;
}
	
#menu8 li a:link, #menu8 li a:visited {
	color: #777;
	display: block;
	background: url(images/menu8.gif);
	padding: 8px 0 0 20px;
}
	
#menu8 li a:hover {
	color: #257EB7;
	background: url(images/menu8.gif) 0 -32px;
	padding: 8px 0 0 25px;
}
	
#menu8 li a:active {
	color: #fff;
	background: url(images/menu8.gif) 0 -64px;
	padding: 8px 0 0 25px;
}

#menu8 ul {
	list-style: none;
	margin: 0;
	padding: 0;
}



body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

.page {
	width:800px;
	text-align:center;
}


</style>
</head>

<body>
<div align="center">
<div class=page>
<div class=header>
<h1 align="center">Rapid Web Developer 1.0</h1>
</div>


<div class=nav2>

  <?php

//initialize page
if (isset($_GET['db']))
{
	// do something
	$db = $_GET['db'];
	
	showtables($db);
	
	if(isset($_GET['table']))
	{
		$table = $_GET['table'];
		
		ReadTemplate($db, $table);
		
		}
	
	
	}
else
{
	showdatabases();
	
	}
	
	
function showcolumns($table)
{
	echo "<div class=\"content\">";
	}
	

function showtables($db)
{
	echo "<h2 align=left>Tables in $db</h2>";
	echo "<div id=\"menu8\"><ul>";
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD);
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query = "SHOW TABLES in $db"; 
    	$result = $mysqli->query($query);
		
				while($row = $result->fetch_row()){ 
					$c++;
		
		
					$fieldname = $row[0];

    				echo "<li><a href=\"?db=$db&table=$fieldname\" title=\"Home\">$fieldname</a></li>";
				}
        
      
		echo "</ul></div>";
	}


function showdatabases()
{
	echo "<h2 align=left>Databases</h2>";
	echo "<div id=\"menu8\"><ul>";
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD);
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query = "SHOW databases "; 
    	$result = $mysqli->query($query);
		
				while($row = $result->fetch_row()){ 
					$c++;
		
		
					$fieldname = $row[0];

    				echo "<li><a href=\"?db=$fieldname\" title=\"Home\">$fieldname</a></li>";
				}
        
      
		echo "</ul></div>";
	
	}

//if (isset($_POST['table']))
function CodeGenerator($db, $table, $str)
{
		$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, $db);
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		$tablename = $table;
		
		//echo $table;
		
		$query = "SHOW COLUMNS FROM ".$tablename; 
		//echo $query;
    	$result = $mysqli->query($query);
		
		
		$code000 = "var \$[fieldname];";
		$properties = file_get_contents("templates/Basic CRUD/core_property.txt");
		$code003 ="\$o".$tablename."->set_[fieldname](\$[fieldname]);";
		
		$insertfields = "";
		$insertfields2 = "";
		$paramfields ="";
		$varFields ="";
		$classParam ="";
		$updateParam = "";
		$ui_fetchParam = "";
		$ui_listParamHeader = "";
		$ui_loadParam ="";
		$ui_viewParam = "";
		$ui_getPostParam ="";
		
		$cConsumerParam = "";
		$varLoadAssign = "";
		
		$testParam ="";
		$echoParam ="";
		
		$fieldcount = $result->num_rows;
		$c=0;

			 
		while($row = $result->fetch_row()){ 
		$c++;
		
		
		$fieldname = $row[0];
		
		$varFields .= str_replace("[fieldname]",$fieldname,$code000)."\n";
		
		$classParam .= str_replace("[fieldname]",$fieldname,$properties)."\n";
		
		$cConsumerParam .= str_replace("[fieldname]",$fieldname,$code003)."\n";
		
		$varLoadAssign .= "	\$this->".$fieldname."=\$row['".$fieldname."'];\n";
		$echoParam .= "echo \$o".$tablename."->".$fieldname.".\"<br>\";\n";
		

		if ($row[5]!="auto_increment")
		{
			$insertfields .= $fieldname;
			$insertfields2 .= "\$".$fieldname;
			$ui_formParams .= "<tr><td><label>".$fieldname." </td><td><input type=text name=\"f_".$fieldname."\"></td></tr>\n";
			$ui_formUpdateParams .= "<tr><td>".$fieldname." </td><td><input type=\"text\" name=\"f_".$fieldname."\" value=\"<?php echo \$o".$tablename."->".$fieldname."?>\"></td></tr>\n";
			$ui_listParamHeader .= "<th scope=\"col\">".$fieldname."</th>";
			$ui_fetchParam .= "<td><?php echo \$row['".$fieldname."']; ?></td>\n";
			$ui_viewParam .= "<tr><td> <?php echo ".$fieldname."; ?></td><td><?php echo \$o".$tablename."->". $fieldname."; ?></td></tr>";
			$ui_getPostParam .= "\$o".$tablename."->".$fieldname."=\$_POST['f_".$fieldname."'];\n";
			
			if ($fieldcount != $c) 
			{	
				$insertfields .= ",";	
				$insertfields2 .= ",";
				
			}
			
			if (substr($row[1],0,3) == "var" )
			{
				$paramfields .= "'\$this->".$fieldname."'";
				$testParam  .= "\$".$fieldname."= getrandstring();\n";
				$updateParam .= $fieldname." = '\$this->".$fieldname."'";
			} 
			elseif (substr($row[1],0,3) == "dat") 
				{				
				$paramfields .= "'\$this->".$fieldname."'";
				$testParam  .= "\$".$fieldname."= date(\"Ymd\");\n";
				$updateParam .= $fieldname."= '\$this->".$fieldname."'";
					
					}
				else {				
				$paramfields .= "\$this->".$fieldname;
				$testParam  .= "\$".$fieldname."= rand();\n";
				$updateParam .= $fieldname." = \$this->".$fieldname;
			}
			
			if ($fieldcount != $c) {
				$paramfields .= ",";
				$updateParam .= ", ";
			}
		} else 
		{
			$ui_listParamHeader .= "<th scope=\"col\" class=\"nobg\" >Action</th>";	
			$ui_fetchParam .= "<th scope=\"row\" class=\"spec\"><a href='".$tablename.".php?do=view&id=<?php echo \$row['".$fieldname."']?>'><?php echo \$row['".$fieldname."']; ?></th>\n";
			}
		}
		
		// Load Code template no 1 --> coreClass.txt
		
		//echo $f;

		//echo "file=".$f;
		
		$m = str_replace("[insertfields]",$insertfields,$str);
		$m= str_replace("[paramfields]",$paramfields,$m);
		
		$m= str_replace("[varLoadAssign]",$varLoadAssign,$m);
		$m = str_replace("[insertfields2]",$insertfields2,$m);
		$m = str_replace("[echoParam]",$echoParam,$m);
		$m = str_replace("[classParam]",$classParam,$m);
		$m = str_replace("[varFields]",$varFields,$m);
		$m = str_replace("[insertFields2]",$insertFields2,$m);
		$m = str_replace("[cConsumerParam]",$cConsumerParam,$m);
		$m = str_replace("[testParam]",$testParam,$m);
		$m = str_replace("[prmTablename]",$tablename,$m);
		$m = str_replace("[updateParam]",$updateParam,$m);
		$m = str_replace("[formParams]",$ui_formParams,$m);
		$m = str_replace("[listParamHeader]",$ui_listParamHeader,$m);
		$m = str_replace("[fetchParam]",$ui_fetchParam,$m);
		$m = str_replace("[viewParam]",$ui_viewParam,$m);
		$m = str_replace("[getPostParam]",$ui_getPostParam,$m);
		$m = str_replace("[formUpdateParams]",$ui_formUpdateParams,$m);
		
	
		
		//echo "<pre>";
		//echo $m;
		//echo "</pre>";
		
		
		return $m;
		
		
		echo "<a href=$file>Open File Now</a>";
	}
	
	
	function ReadTemplate($db, $table)
	{
		
		
		// build class
		$f=file_get_contents("templates/Basic CRUD/Class.txt");
		$code =  CodeGenerator($db, $table,$f);
		$file = "output/cls_".$table.".php";
		file_put_contents($file, $code);
		
		$f=file_get_contents("templates/Basic CRUD/UserInterface.txt");
		$code =  CodeGenerator($db, $table,$f);
		$file = "output/".$table.".php";
		file_put_contents($file, $code);
		
		
	}


	?>
  
  
  </div>
</div>
</div>
</body>
</html>