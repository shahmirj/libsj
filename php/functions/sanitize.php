<?php

foreach ($_GET as $key => $value){
	
	$g_get[$key] = $mysqli->real_escape_string($_GET[$key]);	
}

foreach ($_POST as $key => $value){
	
	$g_post[$key] = $mysqli->real_escape_string($_POST[$key]);	
}

?>