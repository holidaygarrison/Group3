<?php


$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "memehub";

$MHDB = new mysqli($servername, $username, $password, $dbname);

if( $MHDB->connect_error ){
	die("Connection failed: ".$MHDB->connect_error);
	$MHDB = null;
}

?>
