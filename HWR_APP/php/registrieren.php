<?php

header('Access-Control-Allow-Origin: *');
//header('Content-type: application/json');

$server = "127.0.0.3";
$username = "db383509_1";
$password = "hwrapp";
$database = "db383509_1";

/*
 if (empty($_GET))
	echo "nix drin da";
else
	print_r($_GET);
*/
$un = $_GET["un"];
$pw = $_GET["pw"];
$em = $_GET["em"];

$em = strtolower($em);

$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);

$sql = "SELECT *  FROM  `User` where email = '$em'";
$result = mysql_query($sql) or die ("Query error: " . mysql_error());

while($row = mysql_fetch_assoc($result)) {
	$records[] = $row;
}
$new_user = boolean;
if ($records != NULL)
	$new_user = false;
else
	$new_user = true;

function myMd5($str) {
	for ($x=0; $x<99; $x++) {
		$str = md5($str);
	}
	return $str;
}

$Registed = array();
if ($new_user == true) { // Set new member data

	$pw = myMd5($pw);

	$sql = "INSERT INTO `User` (`ID`, `Username`, `Password`, `Email`) VALUES (NULL, '$un', '$pw', '$em')";
	$result = mysql_query($sql) or die ("Query error: " . mysql_error());
	$Registed['Registed'] = 'new user registed';
} else {
	$Registed['Registed'] = 'double email';
}


mysql_close($con);
echo $_GET['jsoncallback'] . '(' . json_encode($Registed) . ');';
?>