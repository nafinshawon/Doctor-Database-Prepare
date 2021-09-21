<?php
//fetch.php
//$connect = mysqli_connect("localhost", "root", "", "stockmanage");
//$request = mysqli_real_escape_string($connect, $_POST["query1"]);
include "connection.php";

$mReporting_DRID = $_POST["mReporting_DRID"];

$selected_mReporting_DRID_Info = explode("-", $mReporting_DRID);

$selected_mReporting_DRID= trim($selected_mReporting_DRID_Info[0]);


//$query = "SELECT * FROM skf_mReporting WHERE SL = (SELECT SL FROM skf_mReporting WHERE mReporting_DRID = " . $selected_mReporting_DRID . " AND STATUS='1')";
//$query = "SELECT * FROM skf_mreporting WHERE SL = (SELECT SL FROM skf_mreporting WHERE mReporting_DRID = " . $selected_mReporting_DRID . " )";
$query = "SELECT * FROM skf_mreporting WHERE SL = (SELECT SL FROM skf_mreporting WHERE mReporting_DRID = '$selected_mReporting_DRID' )";

$result = mysqli_query($conn, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 $data = mysqli_fetch_assoc($result);
 echo json_encode($data);
}

else echo false;

?>