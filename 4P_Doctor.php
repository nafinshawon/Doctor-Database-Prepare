<?php

include "connection.php";
$request = mysqli_real_escape_string($conn, $_POST["query"]);
//$query = "SELECT DISTINCT EMPID, FFNAME FROM employee WHERE EMPID LIKE '%".$request."%' OR FFNAME LIKE '%".$request."%' AND STATUS = '1'  ";

$query = "SELECT DISTINCT DRID_4P, DRNAME_4P, CH_ADD FROM skf_4p WHERE DRID_4P LIKE '%".$request."%' OR DRNAME_4P LIKE '%".$request."%'  OR CH_ADD LIKE '%".$request."%' ";

$result = mysqli_query($conn, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
 // $data[] = $row["EMPID"];
 // $data[] = $row["FFNAME"];
  $data[] = $row["DRID_4P"]." - ".$row["DRNAME_4P"]." - ".$row["CH_ADD"];
 }
 echo json_encode($data);
}

?>