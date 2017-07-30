<?php

class Log
{
	function write($userid, $data, $ip)
	{
		echo "dbuser:".DB_PASSWORD;
		$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		$query = "INSERT INTO SYSTEM_LOG (userid, ip, datecreated, data) value ($userid, '$ip', NOW(),'$data')";
			
		if ($mysqli->query($query)) {
			return true;
		}
	
	/* close connection */
		$mysqli->close();
	
	}
	
	}

?>