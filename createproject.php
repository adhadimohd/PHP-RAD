<?php
require_once "includes/config.php";
require_once "includes/cls_project.php";
require_once "includes/cls_projecttables.php";
require_once "includes/cls_projectcolumns.php";


if (isset($_POST['submit']) && ($_POST['submit']== "Create"))
{
	processInsert();
	exit();
}


function processInsert()
{
	$oproject = new cproject();
	
	$oproject->ProjectName=$_POST['f_ProjectName'];
	$oproject->Database=$_POST['f_Database'];
	$oproject->ApplicationTemplate=$_POST['f_ApplicationTemplate'];
	$ret = $oproject->insert();
	

	if ($ret)
	{
		session_start();
		$_SESSION['appid']=$oproject->id;
		$_SESSION['projectname']=$oproject->ProjectName;
		$_SESSION['database']=$oproject->Database;
		loadTablesIntoProject($oproject->Database,$oproject->id);
		
		//header( "refresh:2;url=rad.php");
		
		echo "Project ".$oproject->ProjectName." has been successfully created.";
	} else
	{
		echo "Error inserting record, and i dont know why.";
	}
	
	
	
}

function loadTablesIntoProject($db, $projectid)
{
	
		$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD);
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query = "SHOW TABLES in $db"; 
    	$result = $mysqli->query($query);
		
		while($row = $result->fetch_row())
		{ 
		
				$c++;
				
				$oprojecttables = new cprojecttables();	
				$oprojecttables->project_id=$projectid;
				$oprojecttables->TableName=$row[0];
				$oprojecttables->TableAlias="";
				$oprojecttables->Description="";
				$oprojecttables->Process=1;
				$oprojecttables->insert();
				
				$mysqli2 = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, $db);
			/* check connection */
				if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
				}
				
				$query2="SHOW COLUMNS in ".$oprojecttables->TableName;
				//echo $query2;
				$result2 = $mysqli2->query($query2);
		
				while($row2 = $result2->fetch_row())
				{ 
				
				
						$oprojectcolumns = new cprojectcolumns();
	
						$oprojectcolumns->table_id=$oprojecttables->id;
						$oprojectcolumns->column_name=$row2[0];
						$oprojectcolumns->column_alias="";
						
						if(substr($row2[1],0,7)== "varchar") 
						{$datatype="varchar";}
						elseif (substr($row2[1],0,3)== "int") 
						{$datatype="int";}
						elseif (substr($row2[1],0,7)== "tinyint") 
						{$datatype="int";}
						else
						{$datatype=$row2[1];}
						
						$oprojectcolumns->data_type=$datatype;
						if ($row2[5]=="auto_increment") {$val=1;} else {$val=0;}
						$oprojectcolumns->is_auto_increment=$val;
						if ($row2[3]=="PRI") {$val=1;} else {$val=0;}
						$oprojectcolumns->is_primary_key=$val;
						$oprojectcolumns->view_form=1;
						$oprojectcolumns->list_view=1;
						$oprojectcolumns->allow_update=1;
						$oprojectcolumns->allow_delete=1;
						if ($row2[5]=="auto_increment") {$val="hidden";} else {$val="text";}
						$oprojectcolumns->input_type=$val;
						$oprojectcolumns->lookup_table="";
						$oprojectcolumns->lookup_table_primarykey_field="";
						$oprojectcolumns->lookup_table_display_field="";
						$oprojectcolumns->lookup_table_onchange="";

						$oprojectcolumns->insert();
							
				}
				
			}
}



?>