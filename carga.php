<?php
function idUnico(){
	// no prefix
	// works only in PHP 5 and later versions
	$token = md5(uniqid());

	// better, difficult to guess
	$better_token = md5(uniqid(mt_rand(), true));
	return $better_token;
}


$db_connection = new mysqli("localhost", 'almarlam_gonzalo' , 'manuela' , 'petzynga');
$db_connection->set_charset("utf8");



$txt_file    = file_get_contents('ukCounties.csv');
$rows        = explode("\n", $txt_file);
array_shift($rows);


$stmt = $db_connection->prepare("INSERT INTO FIRST_REGIONS(FIRST_REGION_ID, FIRST_REGION_NAME, COUNTRY_ID, FIRST_REGION_ALIAS) VALUES (?, ?, ?, ?)");


foreach($rows as $row => $data)
{
	//get row data
	$row_data = explode(';', $data);

	$estado       = $row_data[1];
	$abreviatura =  $row_data[1];
	
	echo $abreviatura . "<br/>";
	
	$stmt->bind_param('ssss', idUnico(), $estado, $id='18ec467572eeb5fdadfacc077ae7c5fa',  $abreviatura);
	$stmt->execute();
	
	
	
}

$stmt->close();
$db_connection->close();


?>