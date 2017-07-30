<?php

require_once "includes/config.php";
require_once "includes/cls_project.php";

if (isset($_GET['do']) && isset($_GET['id']))
{
	if ($_GET['do'] == "load")
	{
		$appid = $_GET['id'];
		
		$oproject = new cproject();
		$oproject->load($appid);
		
		session_start();
		$_SESSION['appId']=$oproject->id;
		$_SESSION['projectname']=$oproject->ProjectName;
		$_SESSION['database']=$oproject->Database;
		header( "refresh:0;url=rad.php");
	
	}
	}
	
	


