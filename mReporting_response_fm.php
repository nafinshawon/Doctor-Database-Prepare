<?php
$result = "";
$result1 = "";
$result2 = "";
$result3 = "";
$result4 = "";
$result5 = "";
$result6 = "";
$result7 = "";
$result8 = "";


if (isset($_POST)) {

    $servername='localhost';
    $username='skfmis_skfdoc';
    $password='$kfdoctorList';
    $dbname = 'skfmis_doctorlist';
    /*
    $servername='localhost';
    $username='skfmis_stocktest';
    $password='stocktest';
    $dbname = 'skfmis_stocktest';
    */
    /*
    $servername='localhost';
    $username='root';
    $password='';
    $dbname = 'demo';
    */

    // Extablishing connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if (!$conn) {
        $result = 'Could not connect: <br>'. $conn->mysql_error();
    } else {

        $tblname = skf_mreporting;
        
        $x = $_POST['value'];
        
        // Successfull conection
       // $sql = "SELECT * FROM ".$tblname. " WHERE `mReporting_DRID`= ".$_POST['value']." LIMIT 1";
       
        $sql = "SELECT * FROM ".$tblname. " WHERE `mReporting_DRID` LIKE '%$x%' LIMIT 1";
        
       //$sql = "SELECT * FROM ".$tblname. " WHERE mReporting_DRID LIKE "%'.$x.'%" LIMIT 1";

        $records = $conn->query($sql);
       
        // Check if records are available
        if ($records->num_rows > 0) {

            // Loop through all the records
            while($data = $records->fetch_assoc()) {
                $result = $data['mReporting_DRNAME'];
               $result1 = $data['DRADDRESS'];
               $result2 = $data['DISTRICT'];
               $result3 = $data['THANA'];
               $result4 = $data['DEGREE'];
               $result5 = $data['NOP'];
               $result6 = $data['SPECIALITY'];
               $result7 = $data['CATEGORY'];
               $result8 = $data['MOBILE'];

            } 
           
        } else {
          //  $result = "No Record Found!";
        } 

    }
}



    // Return the value in json format with three parameter
    $returnValue = json_encode(array('result' => $result,'result1' => $result1,'result2' => $result2,'result3' => $result3,'result4' => $result4,'result5' => $result5, 'result6' => $result6, 'result7' => $result7, 'result8' => $result8 ));

    // Setting the value to json format
    header('Content-Type: application/json');
    echo $returnValue;
   
?>