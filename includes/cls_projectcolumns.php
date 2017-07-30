<?php 
// --------------------------------------------------------------------
// CLASS OBJECT/TEST CLASS FOR TABLE projectcolumns
// Generated by Classmaker.php 
// Created by Adhadi Mohd
// 2011 (C) All Rights Reserved
// --------------------------------------------------------------------

require_once "config.php";
/* Begin Class */

class cprojectcolumns
{
 	var $id;
var $table_id;
var $column_name;
var $column_alias;
var $data_type;
var $is_auto_increment;
var $is_primary_key;
var $view_form;
var $list_view;
var $allow_update;
var $allow_delete;
var $input_type;
var $lookup_table;
var $lookup_table_primarykey_field;
var $lookup_table_display_field;
var $lookup_table_onchange;


	function set_id($val) 
{ 
	$this->id = $val;  
}

function get_id() 
{
	return $this->id;
}

function set_table_id($val) 
{ 
	$this->table_id = $val;  
}

function get_table_id() 
{
	return $this->table_id;
}

function set_column_name($val) 
{ 
	$this->column_name = $val;  
}

function get_column_name() 
{
	return $this->column_name;
}

function set_column_alias($val) 
{ 
	$this->column_alias = $val;  
}

function get_column_alias() 
{
	return $this->column_alias;
}

function set_data_type($val) 
{ 
	$this->data_type = $val;  
}

function get_data_type() 
{
	return $this->data_type;
}

function set_is_auto_increment($val) 
{ 
	$this->is_auto_increment = $val;  
}

function get_is_auto_increment() 
{
	return $this->is_auto_increment;
}

function set_is_primary_key($val) 
{ 
	$this->is_primary_key = $val;  
}

function get_is_primary_key() 
{
	return $this->is_primary_key;
}

function set_view_form($val) 
{ 
	$this->view_form = $val;  
}

function get_view_form() 
{
	return $this->view_form;
}

function set_list_view($val) 
{ 
	$this->list_view = $val;  
}

function get_list_view() 
{
	return $this->list_view;
}

function set_allow_update($val) 
{ 
	$this->allow_update = $val;  
}

function get_allow_update() 
{
	return $this->allow_update;
}

function set_allow_delete($val) 
{ 
	$this->allow_delete = $val;  
}

function get_allow_delete() 
{
	return $this->allow_delete;
}

function set_input_type($val) 
{ 
	$this->input_type = $val;  
}

function get_input_type() 
{
	return $this->input_type;
}

function set_lookup_table($val) 
{ 
	$this->lookup_table = $val;  
}

function get_lookup_table() 
{
	return $this->lookup_table;
}

function set_lookup_table_primarykey_field($val) 
{ 
	$this->lookup_table_primarykey_field = $val;  
}

function get_lookup_table_primarykey_field() 
{
	return $this->lookup_table_primarykey_field;
}

function set_lookup_table_display_field($val) 
{ 
	$this->lookup_table_display_field = $val;  
}

function get_lookup_table_display_field() 
{
	return $this->lookup_table_display_field;
}

function set_lookup_table_onchange($val) 
{ 
	$this->lookup_table_onchange = $val;  
}

function get_lookup_table_onchange() 
{
	return $this->lookup_table_onchange;
}



	function insert()
	{
		$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		/* check connection */
	
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query= "INSERT INTO projectcolumns (table_id,column_name,column_alias,data_type,is_auto_increment,is_primary_key,view_form,list_view,allow_update,allow_delete,input_type,lookup_table,lookup_table_primarykey_field,lookup_table_display_field,lookup_table_onchange) VALUES ($this->table_id,'$this->column_name','$this->column_alias','$this->data_type',$this->is_auto_increment,$this->is_primary_key,$this->view_form,$this->list_view,$this->allow_update,$this->allow_delete,'$this->input_type','$this->lookup_table','$this->lookup_table_primarykey_field','$this->lookup_table_display_field','$this->lookup_table_onchange')";
		
		//echo $query;
		
		if ($mysqli->query($query)) {
			
			$this->id = $mysqli->insert_id;
			
			return true;
		} else { return false;}
	
		/* close connection */
		$mysqli->close();
	
	}
	
	
function delete($id)
	{
		$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		/* check connection */
	
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query= "DELETE FROM projectcolumns WHERE id = $id";
		
		//echo $query;
		
		if ($mysqli->query($query)) {
			
		
			return true;
	
		} else { return false;}
	
		/* close connection */
		$mysqli->close();
	
	}
	
	
function update($id)
	{
		$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		/* check connection */
	
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query= "UPDATE projectcolumns SET table_id = $this->table_id, column_name = '$this->column_name', column_alias = '$this->column_alias', data_type = '$this->data_type', is_auto_increment = $this->is_auto_increment, is_primary_key = $this->is_primary_key, view_form = $this->view_form, list_view = $this->list_view, allow_update = $this->allow_update, allow_delete = $this->allow_delete, input_type = '$this->input_type', lookup_table = '$this->lookup_table', lookup_table_primarykey_field = '$this->lookup_table_primarykey_field', lookup_table_display_field = '$this->lookup_table_display_field', lookup_table_onchange = '$this->lookup_table_onchange' WHERE id = $id";
		
		//echo $query;
		
		if ($mysqli->query($query)) {
			
		
			return true;
	
		} else { return false;}
	
		/* close connection */
		$mysqli->close();
	
	}





function load($id)
{
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		/* check connection */
	
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query= "SELECT * FROM projectcolumns where id=$id";
		//echo $query;
		$result = $mysqli->query($query);
		$row = $result->fetch_assoc();
		//echo $row['id'];
		
			$this->id=$row['id'];
	$this->table_id=$row['table_id'];
	$this->column_name=$row['column_name'];
	$this->column_alias=$row['column_alias'];
	$this->data_type=$row['data_type'];
	$this->is_auto_increment=$row['is_auto_increment'];
	$this->is_primary_key=$row['is_primary_key'];
	$this->view_form=$row['view_form'];
	$this->list_view=$row['list_view'];
	$this->allow_update=$row['allow_update'];
	$this->allow_delete=$row['allow_delete'];
	$this->input_type=$row['input_type'];
	$this->lookup_table=$row['lookup_table'];
	$this->lookup_table_primarykey_field=$row['lookup_table_primarykey_field'];
	$this->lookup_table_display_field=$row['lookup_table_display_field'];
	$this->lookup_table_onchange=$row['lookup_table_onchange'];

	
	}}

/* End Class */





// ---------------------------------------------------------------
//  CODE FOR TESTING
// ---------------------------------------------------------------
class cprojectcolumnsTest

{
	
	function testInsert($table_id,$column_name,$column_alias,$data_type,$is_auto_increment,$is_primary_key,$view_form,$list_view,$allow_update,$allow_delete,$input_type,$lookup_table,$lookup_table_primarykey_field,$lookup_table_display_field,$lookup_table_onchange) 
	
	{
		$oprojectcolumns= new cprojectcolumns();
	
	$oprojectcolumns->set_id($id);
$oprojectcolumns->set_table_id($table_id);
$oprojectcolumns->set_column_name($column_name);
$oprojectcolumns->set_column_alias($column_alias);
$oprojectcolumns->set_data_type($data_type);
$oprojectcolumns->set_is_auto_increment($is_auto_increment);
$oprojectcolumns->set_is_primary_key($is_primary_key);
$oprojectcolumns->set_view_form($view_form);
$oprojectcolumns->set_list_view($list_view);
$oprojectcolumns->set_allow_update($allow_update);
$oprojectcolumns->set_allow_delete($allow_delete);
$oprojectcolumns->set_input_type($input_type);
$oprojectcolumns->set_lookup_table($lookup_table);
$oprojectcolumns->set_lookup_table_primarykey_field($lookup_table_primarykey_field);
$oprojectcolumns->set_lookup_table_display_field($lookup_table_display_field);
$oprojectcolumns->set_lookup_table_onchange($lookup_table_onchange);

	
	$oprojectcolumns->insert();
	return $oprojectcolumns->get_id();
	}
	
	function testUpdate($id,$table_id,$column_name,$column_alias,$data_type,$is_auto_increment,$is_primary_key,$view_form,$list_view,$allow_update,$allow_delete,$input_type,$lookup_table,$lookup_table_primarykey_field,$lookup_table_display_field,$lookup_table_onchange) 
	
	{
		$oprojectcolumns= new cprojectcolumns();
	
	$oprojectcolumns->set_id($id);
$oprojectcolumns->set_table_id($table_id);
$oprojectcolumns->set_column_name($column_name);
$oprojectcolumns->set_column_alias($column_alias);
$oprojectcolumns->set_data_type($data_type);
$oprojectcolumns->set_is_auto_increment($is_auto_increment);
$oprojectcolumns->set_is_primary_key($is_primary_key);
$oprojectcolumns->set_view_form($view_form);
$oprojectcolumns->set_list_view($list_view);
$oprojectcolumns->set_allow_update($allow_update);
$oprojectcolumns->set_allow_delete($allow_delete);
$oprojectcolumns->set_input_type($input_type);
$oprojectcolumns->set_lookup_table($lookup_table);
$oprojectcolumns->set_lookup_table_primarykey_field($lookup_table_primarykey_field);
$oprojectcolumns->set_lookup_table_display_field($lookup_table_display_field);
$oprojectcolumns->set_lookup_table_onchange($lookup_table_onchange);

	
	
	$ret= $oprojectcolumns->update($id);
	
	if ($ret>0)
		{
		return $ret;
		} else {
		return false;
		}
	}
	
	
	
	function getrandstring()
	{
		$n = rand(10e16, 10e20);
		return base_convert($n, 10, 36);
	}
	
	
	// --------------------------------------------------------------
	function testLoad($id)
	{
	
	$oprojectcolumns= new cprojectcolumns();
	$oprojectcolumns->load($id);
	
	echo $oprojectcolumns->id."<br>";
echo $oprojectcolumns->table_id."<br>";
echo $oprojectcolumns->column_name."<br>";
echo $oprojectcolumns->column_alias."<br>";
echo $oprojectcolumns->data_type."<br>";
echo $oprojectcolumns->is_auto_increment."<br>";
echo $oprojectcolumns->is_primary_key."<br>";
echo $oprojectcolumns->view_form."<br>";
echo $oprojectcolumns->list_view."<br>";
echo $oprojectcolumns->allow_update."<br>";
echo $oprojectcolumns->allow_delete."<br>";
echo $oprojectcolumns->input_type."<br>";
echo $oprojectcolumns->lookup_table."<br>";
echo $oprojectcolumns->lookup_table_primarykey_field."<br>";
echo $oprojectcolumns->lookup_table_display_field."<br>";
echo $oprojectcolumns->lookup_table_onchange."<br>";

	
	}
	
	
	
	// --------------------------------------------------------------
	function testDelete($id)
	{
	
	$oprojectcolumns= new cprojectcolumns();
	$ret = $oprojectcolumns->delete($id);
	
	if ($ret)
	{ echo "Delete Success"; }
	else
	{ echo "Delete Failed"; }
	
	}
	
	// ------------------ Begin Testing ------------------------------
	function BeginTest()
	{
	
	echo "<h2>Begin Test</h2>";
	$table_id= rand();
$column_name= getrandstring();
$column_alias= getrandstring();
$data_type= getrandstring();
$is_auto_increment= rand();
$is_primary_key= rand();
$view_form= rand();
$list_view= rand();
$allow_update= rand();
$allow_delete= rand();
$input_type= getrandstring();
$lookup_table= getrandstring();
$lookup_table_primarykey_field= getrandstring();
$lookup_table_display_field= getrandstring();
$lookup_table_onchange= getrandstring();

	
	
	$retVal = $this->testInsert($table_id,$column_name,$column_alias,$data_type,$is_auto_increment,$is_primary_key,$view_form,$list_view,$allow_update,$allow_delete,$input_type,$lookup_table,$lookup_table_primarykey_field,$lookup_table_display_field,$lookup_table_onchange);
	
	echo "<h4>Test Insert</h4>";
	if ($retVal>0)
	{ 
	echo "Test Insert [SUCCESS] with ID Value $retVal <br>";
	} else
	echo "Test Insert [Failed]  <br>";
	
	echo "<h4>Test Load</h4>";
	$this->testLoad($retVal);
	
	
	echo "<h4>Test Update</h4>";
	$table_id= rand();
$column_name= getrandstring();
$column_alias= getrandstring();
$data_type= getrandstring();
$is_auto_increment= rand();
$is_primary_key= rand();
$view_form= rand();
$list_view= rand();
$allow_update= rand();
$allow_delete= rand();
$input_type= getrandstring();
$lookup_table= getrandstring();
$lookup_table_primarykey_field= getrandstring();
$lookup_table_display_field= getrandstring();
$lookup_table_onchange= getrandstring();

	$this->testUpdate($retVal,$table_id,$column_name,$column_alias,$data_type,$is_auto_increment,$is_primary_key,$view_form,$list_view,$allow_update,$allow_delete,$input_type,$lookup_table,$lookup_table_primarykey_field,$lookup_table_display_field,$lookup_table_onchange );
	
	echo "<h4>Test Load After Update</h4>";
	$this->testLoad($retVal);
	
	echo "<h4>Test Delete</h4>";
	$this->testDelete($retVal);
	}
}




?>