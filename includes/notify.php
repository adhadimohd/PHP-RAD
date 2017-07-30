<?php
//notification by adhadi mohd

function notifybyemail($target,$from, $subject, $message)
{
	$headers = "From:" . $from;
	mail($target,$subject,$message,$headers);
	
	}