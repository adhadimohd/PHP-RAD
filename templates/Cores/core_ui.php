<?php

class Button
{
	
	function Create()
	{	
		echo "<a href=\"?do=add\" class=\"button green medium\">New Record</a> ";
	}	
		
	function Listview()
	{
	echo "<br><a href=\"?do=\" class=\"button green medium\">
		Listview
	</a>";
	}

	function Edit($id) {
	echo "	<a href=\"?do=edit&id=$id\" class=\"button green medium\">
		Edit
	</a>";
	}
	

	function Delete($id) {
	echo "	<a href=\"?do=delete&id=$id\" class=\"button green medium\">
		Delete
	</a>";
	}
	
	function ConfirmDelete($id) {
	echo "	<a href=\"?do=confirmdelete&id=$id\" class=\"button green medium\">
		Confirm
	</a>";
	}
	
	function Browse($record_count,$record_limit ,$current_page )
	{
		$p=0;
		for ($i=0;$i<=$record_count; $i+=$record_limit)
		{
			$p++;
			if ($p==$current_page)
				{$style="button red small";}
				else
				{$style="button gray small";}
				
			echo "<a class=\"$style\" href=\"?rs=$i&p=$p\">$p</a>";
		}
	}
	
}




class Form
{
	
	function Uploader($fieldname)
	{
	echo "		<p class=\"iform\">\n
		<label><span class=tfield>$fieldname</span></label>\n
				<input name=\"f_$fieldname\" type=file>
					</p>\n";
		
		}
	
	
	
	function Textbox($fieldname, $value)
	{
	echo "	<p class=\"iform\">\n
				<label><span class=tfield>$fieldname</span></label>\n
				<input class=textbox type=text name=\"f_$fieldname\" value=\"$value\">\n
				</p>\n";
		
		}
	
	

	
	
	} // end form

?>
    
	