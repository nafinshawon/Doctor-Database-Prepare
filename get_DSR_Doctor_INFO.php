<?php
//fetch.php
//$connect = mysqli_connect("localhost", "root", "", "stockmanage");
//$request = mysqli_real_escape_string($connect, $_POST["query1"]);
include "connection.php";

$DSR_DRID = $_POST["DSR_DRID"];

$selected_DSR_DRID_Info = explode("-", $DSR_DRID);

$selected_DSR_DRID= trim($selected_DSR_DRID_Info[0]);


//$query = "SELECT * FROM skf_mReporting WHERE SL = (SELECT SL FROM skf_mReporting WHERE mReporting_DRID = " . $selected_mReporting_DRID . " AND STATUS='1')";
$query = "SELECT * FROM skf_dsr WHERE SL = (SELECT SL FROM skf_dsr WHERE DSR_DRID = " . $selected_DSR_DRID . " )";

$result = mysqli_query($conn, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 $data = mysqli_fetch_assoc($result);
 echo json_encode($data);
}

else echo false;

?>