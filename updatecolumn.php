<?php
require_once "includes/config.php";
require_once "includes/cls_project.php";
require_once "includes/cls_projecttables.php";
require_once "includes/cls_projectcolumns.php";

$url = $_SERVER['HTTP_REFERER'];

?>

<?php


//print_r($_POST['id']);

$cols = $_POST['id'];
$alias = $_POST['alias'];
$input = $_POST['input'];
$view = $_POST['chkview'];
$list = $_POST['chklist'];

if (empty($cols))
{
	echo "test";
	} 
	else
	{
		$c= count($cols);
		
		for ($i=0; $i < $c; $i++)
		{
			

			
		
			
			$oc = new cprojectcolumns();
			$oc->load($cols[$i]);
			
			$oc->column_alias=$alias[$i];
			$oc->input_type=$input[$i];
	
	
			// semak view
			if (isset($view[$cols[$i]]))
			{			
			$oc->view_form=1;
			}

			else
			{			
				$oc->view_form=0;
			}
			
			//semak list
			if (isset($list[$cols[$i]]))
			{			
				$oc->list_view=1;
			}

			else
			{			
				$oc->list_view=0;
			}
			
			
			$oc->update($cols[$i]);
			
						
			}
				
		}
	
	echo "<script>window.location='$url'</script>";
?>
