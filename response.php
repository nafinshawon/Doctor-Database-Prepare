<?php
$result = "";
$result1 = "";

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

    // Extablishing connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if (!$conn) {
        $result = 'Could not connect: <br>'. $conn->mysql_error();
    } else {

        $tblname = skf_dsr;
        // Successfull conection
        $sql = "SELECT * FROM ".$tblname. " WHERE `DSR_DRID`= ".$_POST['value']." LIMIT 1";

        $records = $conn->query($sql);
       
        // Check if records are available
        if ($records->num_rows > 0) {

            // Loop through all the records
            while($data = $records->fetch_assoc()) {
                $result = $data['DSR_DRNAME'];
                //$result = $data['DSR_DRNAME']. $data['DRADDRESS'];
               $result1 = $data['DRADDRESS'];
            } 
           
        } else {
          //  $result = "No Record Found!";
        } 

    }
}



    // Return the value in json format with three parameter
    $returnValue = json_encode(array('result' => $result,'result1' => $result1));

    // Setting the value to json format
    header('Content-Type: application/json');
    echo $returnValue;
   
?>