<?php

$clientId = $_POST['mReporting_DRID']; // Selected Client Id

$query  = "SELECT mReporting_DRID, mReporting_DRNAME, DRADDRESS from Client where mReporting_DRID = $clientId";
$result = mysql_query($query);
$row = mysql_fetch_array($result, MYSQL_ASSOC);

$add1 = $row[mReporting_DRNAME];
$add2 = $row[DRADDRESS];
$gender = 1;

$arr = array( 'input#mReporting_DRNAME' => $add1, 'input#DRADDRESS' => $add2, 'select#NOP' => $gender );
echo json_encode( $arr );

?>
