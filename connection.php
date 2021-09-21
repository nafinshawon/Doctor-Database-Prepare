<?php
/*
$servername='localhost';
$username='root';
$password='';
$dbname = "demo";
*/
/*
$servername='localhost';
$username='skfmis_stocktest';
$password='stocktest';
$dbname = 'skfmis_stocktest';
*/

$servername='localhost';
$username='skfmis_skfdoc';
$password='$kfdoctorList';
$dbname = 'skfmis_doctorlist';

$conn=mysqli_connect($servername,$username,$password,"$dbname");
if(!$conn){
die('Could not Connect My Sql:' .mysql_error());
}
?>