<?php


function dbOpen() {

	$host = 'localhost';
	$user = 'demens';
	$pw = 'demens';
	$database = 'demens';
/*
	$host = 'mysql.hostinger.de';
	$user = 'u996948253_root';
	$pw = 'db-demens';
	$database = 'u996948253_demen';
*/

	$dbCon = mysql_connect($host, $user, $pw) or die ("Error connecting to db-server");

	mysql_select_db($database);
	return $dbCon;	
}

function dbClose() {
	mysql_close();
}


?>
