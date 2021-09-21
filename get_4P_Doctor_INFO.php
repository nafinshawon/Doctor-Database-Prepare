<?php
//fetch.php
//$connect = mysqli_connect("localhost", "root", "", "stockmanage");
//$request = mysqli_real_escape_string($connect, $_POST["query1"]);
include "connection.php";

$DRID_4P = $_POST["DRID_4P"];

$selected_4P_DRID_Info = explode("-", $DRID_4P);

$selected_4P_DRID= trim($selected_4P_DRID_Info[0]);

//echo $selected_4P_DRID;

//$query = "SELECT * FROM skf_mReporting WHERE SL = (SELECT SL FROM skf_mReporting WHERE mReporting_DRID = " . $selected_mReporting_DRID . " AND STATUS='1')";
//$query = "SELECT * FROM skf_4p WHERE SL = (SELECT SL FROM skf_4p WHERE DRID_4P =  " . $selected_4P_DRID . " )";
$query = "SELECT * FROM skf_4p WHERE SL = (SELECT SL FROM skf_4p WHERE DRID_4P =    '$selected_4P_DRID' )";
//echo $query;

$result = mysqli_query($conn, $query);

$data = array();

//while($row = mysqli_fetch_array($result))
if(mysqli_num_rows($result) > 0)
{
//echo $selected_4P_DRID;
 	$data = mysqli_fetch_assoc($result);
 	echo json_encode($data);
}

else echo false;

?>