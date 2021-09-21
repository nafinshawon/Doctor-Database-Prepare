<?php

include "connection.php";
$request = mysqli_real_escape_string($conn, $_POST["query"]);
//$query = "SELECT DISTINCT EMPID, FFNAME FROM employee WHERE EMPID LIKE '%".$request."%' OR FFNAME LIKE '%".$request."%' AND STATUS = '1'  ";

$query = "SELECT DISTINCT IDCUST, NAMECUST, MARKETNAME FROM skf_customer_information WHERE IDCUST LIKE '%".$request."%' OR NAMECUST LIKE '%".$request."%'  OR MARKETNAME LIKE '%".$request."%' ";

$result = mysqli_query($conn, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
 // $data[] = $row["EMPID"];
 // $data[] = $row["FFNAME"];
  $data[] = $row["IDCUST"]." - ".$row["NAMECUST"]." - ".$row["MARKETNAME"];
 }
 echo json_encode($data);
}

?>