
<?

function showcolumns($db, $table)
{
		$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, "radtools");
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		$tablename = $table;
		
		$query = "select * from projectcolumns where table_id=".$table; 
    	$result = $mysqli->query($query);
		//echo $query;
		echo "<form name=column method=post action=updatecolumn.php>";
		echo "<table id=tablecolumns>\n";	
		echo "	<caption>Showing columns from table <span class=red>$table</span></caption>\n";
		
		echo "	<tr>\n";
		echo "		<td>View</td>\n";
		echo "		<td>List</td>\n";
		echo "		<td><span class=orange>Column</span> </td>\n";
		echo "		<td><span class=orange>Alias</span> </td>\n";
		echo "		<td>Type</td>\n";
		echo "		<td>P_K</td>\n";
		echo "		<td>A_I</td>\n";
		echo "		<td>Input</td>\n";

		echo "	</tr>\n";
		while($row = $result->fetch_assoc()){ 
			$c++;
			$id= $row['id'];
			$fieldname = $row['column_name'];
			$fieldalias = $row['column_alias'];
			$datatype = $row['data_type'];
			$a_i = $row['is_auto_increment'];
			$p_k = $row['is_primary_key'];
			$view = $row['view_form'];	
			$list = $row['list_view'];	
			$input_type = $row['input_type'];		
			
			echo "	<tr>\n";
			if ($view==1) 
			{$checked = "checked";} 
			else 
			{$checked = "";}
			
			if ($list==1) 
			{$list_checked = "checked";} 
			else 
			{$list_checked = "";}
			
			
			echo "		<td><input type=\"hidden\" name=\"id[]\" value=$id>";
			echo "      <input type=\"checkbox\" name=\"chkview[$id]\" $checked value=\"$id\"></td>\n";
			echo "		<td><input type=\"checkbox\" name=\"chklist[$id]\" $list_checked value=\"$id\"></td>\n";
			echo "		<td>$fieldname</td>\n";
			echo "		<td><input id=fieldalias type=text name=\"alias[]\" value=\"$fieldalias\"></td>\n";
			echo "		<td>$datatype</td>\n";
			echo "		<td>$p_k</td>\n";
			echo "		<td>$a_i</td>\n";
			echo "		<td><select name=input[]>\n";
			createOption($input_type);
			echo "		</select></td>\n";
			
			echo "	</tr>\n";
			
		}
		echo "</table>";
		
		echo "<button type=submit>Update Application Setting</button>";
		echo "<button type=submit value=GenerateUI>Generate Form</button>";
		echo "<button type=submit value=GenerateFullClass>Generate Full App</button>";
		echo "<form>";
		
		
	}
	
function createOption($sel)
{
$selText = $sel=='text' ? 'selected':'';
$selArea = $sel=='textarea' ? 'selected':'';
$selChk = $sel=='checkbox' ? 'selected':'';
$selHidden = $sel=='hidden' ? 'selected':'';
$selSelect = $sel=='select' ? 'selected':'';
$selMaster = $sel=='master' ? 'selected':'';
$selCal = $sel=='calendar' ? 'selected':'';

			echo "			<option value=text $selText>Text</option>\n";
			echo "			<option value=textarea $selArea>Textarea</option>\n";
			echo "			<option value=checkbox $selChk>Checkbox</option>\n";
			echo "			<option value=hidden $selHidden>Hidden</option>\n";
			echo "			<option value=select $selSelect>Select</option>\n";
			echo "			<option value=master $selMaster>Master</option>\n";
			echo "			<option value=calendar $selCal>Calendar</option>\n";
	
	}
	
function showtables($db)
{
	echo "<h2 align=left>Tables in $db</h2>";
	echo "<div id=\"menu8\"><ul>";
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, "radtools");
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query = "select * from projecttables where project_id=".$_SESSION['appId']; 
		
		//echo $_SESSION['appId'];
    	$result = $mysqli->query($query);
		
				while($row = $result->fetch_row()){ 
					$c++;
		
		
					$fieldname = $row[2];
					$tid = $row[0];

    				echo "<li><a href=\"?db=$db&table=$tid\" title=\"Home\">$fieldname</a></li>";
				}
        
      
		echo "</ul></div>";
	}


function listdatabases($container)
{
		if ($container == "option")
		{
			$template = "<option value=[fieldname]>[fieldname]</option>";
			}
	
		$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD);
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$str = "";
		
		$query = "SHOW databases "; 
    	$result = $mysqli->query($query);
		
				while($row = $result->fetch_row()){ 
					$c++;
		
		
					$fieldname = $row[0];
					$t = str_replace("[fieldname]",$fieldname,$template);
					$str .= $t;
				}

	return $str;

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
		
		$query = "SHOW COLUMNS FROM ".$tablename; 
    	$result = $mysqli->query($query);
		
		
		$code000 = "var \$[fieldname];";
		$properties = file_get_contents("templates/Cores/core_property.txt");
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
		
		$enctype = "";
		
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
	
	
			$tmpformUpdateParams =  "<?php Form::Textbox($fieldname,\$o".$tablename."->".$fieldname.");?>";
			$ui_listParamHeader .= "<th scope=\"col\">".$fieldname."</th>\n";
			
			$ui_viewParam .= "<tr><td> <?php echo ".$fieldname."; ?></td><td><?php echo \$o".$tablename."->". $fieldname."; ?></td></tr>\n";
			$ui_getPostParam .= "\$o".$tablename."->".$fieldname."=\$_POST['f_".$fieldname."'];\n";
			
			if ($fieldcount != $c) 
			{	
				$insertfields .= ",";	
				$insertfields2 .= ",";
				
			}
			
			
			
			// CHECKING DISPLAY BASED ON DATA TYPE
			if (substr($row[1],0,3) == "var" )
			{
				$paramfields .= "'\$this->".$fieldname."'";
				$testParam  .= "\$".$fieldname."= getrandstring();\n";
				$updateParam .= $fieldname." = '\$this->".$fieldname."'";
				$tmpfetchParam = "<td><?php echo \$row['".$fieldname."']; ?></td>\n";
				
				// insert
				$tmpformParams =  "<?php Form::Textbox($fieldname, '');?>";
				
				
			} 
			// Date time
			elseif (substr($row[1],0,3) == "dat") 
				{				
				$paramfields .= "'\$this->".$fieldname."'";
				$testParam  .= "\$".$fieldname."= date(\"Ymd\");\n";
				$updateParam .= $fieldname."= '\$this->".$fieldname."'";
				$tmpfetchParam = "<td><?php echo \$row['".$fieldname."']; ?></td>\n";

				// insert
				$tmpformParams =  "<?php Form::Textbox($fieldname, '');?>";
				
				// patut date calendar jquery ni
					$tmpformUpdateParams =  "<?php Form::Textbox($fieldname,\$o".$tablename."->".$fieldname.");?>";
				}
					

			else {				
				$paramfields .= "\$this->".$fieldname;
				$testParam  .= "\$".$fieldname."= rand();\n";
				$updateParam .= $fieldname." = \$this->".$fieldname;
				$tmpfetchParam = "<td><?php echo \$row['".$fieldname."']; ?></td>\n";

				// insert
				$tmpformParams =  "<?php Form::Textbox($fieldname, '');?>";
			}
			
	
			
			// finally check if last 2 is _ID, change to combobox
			$ufieldname = strtoupper($fieldname);
			
			// ---------------------
			// LOOKUP: check kalau field ada extension ID. Make sure refer kepada table yang betul
			//----------------------
			if (strstr($ufieldname, "_ID")=="_ID")
			{
				//echo "found";
				$lookuptable = str_replace("_ID","",$ufieldname);
		
				
				$tmpformParams = "<p class=\"iform\">\n
				<label><span class=tfield>$lookuptable</span></label>\n
				<select name=\"f_$fieldname\">\n 
				<?php echo loadLookup(\"".$lookuptable."\"); ?>;
				</select>\n
				</p>\n";
				
				$tmpformUpdateParams =  "<p class=\"iform\">\n
				<label><span class=tfield>$lookuptable</span></label>\n
				<select name=\"f_$fieldname\">\n 
				<?php echo loadLookup(\"".$lookuptable."\"); ?>;
				</select>\n
				</p>\n";
			
				
				}
				
				

			// ---------------------
			// PHOTO : kalau fieldname adalah PHOTO. Make sure kita create Photo Upload Utility, View
			//----------------------
			if ($ufieldname=="PHOTO")
			{
				//echo "found";
				
				$tmpformParams = "<?php Form::Uploader($fieldname); ?>";
				
				
				// tukar enctype
				$enctype = "enctype=\"multipart/form-data\"";
				
				$tmpfetchParam = "<td><img src=\"upload/s_<?php echo \$row['".$fieldname."']; ?>\"></td>\n";
				$tmpformUpdateParams =  "<?php Form::Uploader($fieldname); ?>";
			
			}
			
			// FINALLY : GET THE REAL UI DISPLAY {PARAM dan FORM PARAMETERS
			
			$ui_formParams .= $tmpformParams;
			$ui_fetchParam .= $tmpfetchParam;
			$ui_formUpdateParams .= $tmpformUpdateParams;
			
			if ($fieldcount != $c) {
				$paramfields .= ",";
				$updateParam .= ", ";
			}
		} else 
		{
			$ui_listParamHeader .= "<th scope=\"col\" class=\"nobg\" >Action</th>";	
			$ui_fetchParam .= "<th scope=\"row\" class=\"spec\">\n
			<a href='".$tablename.".php?do=view&id=<?php echo \$row['".$fieldname."']?>'>\n
			<?php echo \$row['".$fieldname."']; ?>\n
			</th>\n";
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
		$m = str_replace("[enctype]",$enctype,$m);
		
	
		
		//echo "<pre>";
		//echo $m;
		//echo "</pre>";
		
		
		return $m;
		
		
		//echo "<a href=$file>Open File Now</a>";
	}
	
	function DoCodeGenerate($appId, $db)
	{
	echo "<h2 align=left>Generating codes for $db</h2>";
	
	//Define new output folder
	
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, "radtools");
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query = "select * from project where id=$appId"; 
		//echo $query;
		
    	$result = $mysqli->query($query);
		$row = $result->fetch_row();
		$templatefolder = $row[3];
		$curDate = date("YmdHis");
		
		
		
		$of = "output/$db/$curDate/";
		$ofc = "output/$db/$curDate/classes";
		$ofi = "output/$db/$curDate/images";
		$ofcs = "output/$db/$curDate/css";
		if (!mkdir($of, 0, true)) {
   		 die('Failed to create folders...');
		}
		
		if (!mkdir($ofc, 0, true)) {
   		 die('Failed to create folders...');
		}
	
		if (!mkdir($ofi, 0, true)) {
   		 die('Failed to create folders...');
		}
		
		if (!mkdir($ofcs, 0, true)) {
   		 die('Failed to create folders...');
		}
	
		
	
		echo "<ul>";
	
	
		//generate codes - table level
		
		$table_core[0] = "<li class=navigation_item><a href=\"[LINK]\" class=\"navbutton medium white\">[TITLE]</a></li>";
		
		$query = "SHOW TABLES in $db"; 
    	$result = $mysqli->query($query);
		
				while($row = $result->fetch_row()){ 
					$c++;
					
					$fieldname = $row[0];
					$link_ui = $fieldname.".php";
					$tmp = str_replace("[LINK]",$link_ui, $table_core[0]);
					$tmp = str_replace("[TITLE]",$fieldname,$tmp);
					//echo  $table_core[0];
					$navcode .= $tmp."\n";

    				ReadTemplate ($appId, $db, $fieldname, $templatefolder, $of);
				}
        
		// echo $navcode;
		
		$f=file_get_contents("templates/cores/nav.txt");
		$code =  str_replace("[NAVITEM]",$navcode,$f);
		$file = $of."nav.php";
		file_put_contents($file, $code);
		
      	generateCores($db,$of);
		echo "</ul>";
		echo "<h2>All Tables Code Generated</h2>";
		
		}
	
	function ReadTemplate($appId, $db, $table, $templatefolder, $outfolder)
	{
		
		$f=file_get_contents("templates/$templatefolder/Class.txt");
		$code =  CodeGenerator($db, $table,$f);
		$file = $outfolder."classes/cls_".$table.".php";
		file_put_contents($file, $code);
		echo "<li><a href=\"$file\" >Class Component for <span class=t_orange>$file</span> created</li>";
		
		$f=file_get_contents("templates/$templatefolder/UserInterface.txt");
		$code =  CodeGenerator($db, $table,$f);
		$file = $outfolder.$table.".php";
		file_put_contents($file, $code);
		
		echo "<li><a href=\"$file\" >User interface Component <span class=t_orange>$file</span> created</li>"; 	
	}
	
	
function generateCores($db, $outfolder)
{

		
		
		
		$f=file_get_contents("templates/cores/config.php");
		$code =  str_replace("[dbname]",$db,$f);
		$file = $outfolder."config.php";
		file_put_contents($file, $code);
		echo "<li><a href=\"$file\" >Configuration for <span class=orange>$db</span> created</li>";
		
		
		
		//copy file style to css folder
		$cssNew = $outfolder."css";				
		full_copy ("templates/cores/css", $cssNew);
		echo "<li><a href=\"$file\" >Stylesheet for <span class=orange>$db</span> created</li>";
		
		//copy file style to js folder
		$cssNew = $outfolder."js";				
		full_copy ("templates/cores/js", $cssNew);
		echo "<li><a href=\"$file\" >JQuery scripts for <span class=orange>$db</span> created</li>";
		
		//copy file style to css folder
		$cssNew = $outfolder."classes/core_ui.php";				
		copy ("templates/cores/core_ui.php", $cssNew);
		echo "<li><a href=\"$file\" >UI CORE for <span class=orange>$db</span> created</li>";
		
		
		
	}
	
function folderlist($startdir){

  $ignoredDirectory[] = '.';
  $ignoredDirectory[] = '..';
   if (is_dir($startdir)){
       if ($dh = opendir($startdir)){
           while (($folder = readdir($dh)) !== false){
               if (!(array_search($folder,$ignoredDirectory) > -1)){
                 if (filetype($startdir . $folder) == "dir"){
                       $directorylist[$startdir . $folder]['name'] = $folder;
                       $directorylist[$startdir . $folder]['path'] = $startdir;
                   }
               }

           }

           closedir($dh);

       }

   }

return($directorylist);

}


function full_copy( $source, $target ) {
    if ( is_dir( $source ) ) {
        @mkdir( $target );
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry; 
            if ( is_dir( $Entry ) ) {
                full_copy( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }

        $d->close();
    }else {
        copy( $source, $target );
    }
}

	?>