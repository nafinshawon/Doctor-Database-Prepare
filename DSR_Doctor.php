<?php

include "connection.php";
$request = mysqli_real_escape_string($conn, $_POST["query"]);
//$query = "SELECT DISTINCT EMPID, FFNAME FROM employee WHERE EMPID LIKE '%".$request."%' OR FFNAME LIKE '%".$request."%' AND STATUS = '1'  ";

$query = "SELECT DISTINCT DSR_DRID, DSR_DRNAME, DRADDRESS FROM skf_dsr WHERE DSR_DRID LIKE '%".$request."%' OR DSR_DRNAME LIKE '%".$request."%'    OR DRADDRESS LIKE '%".$request."%'  ";

$result = mysqli_query($conn, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
 // $data[] = $row["EMPID"];
 // $data[] = $row["FFNAME"];
  $data[] = $row["DSR_DRID"]." - ".$row["DSR_DRNAME"]." - ".$row["DRADDRESS"];
 }
 echo json_encode($data);
}

?>