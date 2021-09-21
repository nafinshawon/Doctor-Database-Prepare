<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: index.html');
  exit;
}

$DATABASE_HOST='localhost';
$DATABASE_USER='skfmis_skfdoc';
$DATABASE_PASS='$kfdoctorList';
$DATABASE_NAME = 'skfmis_doctorlist';
/*
$DATABASE_HOST='localhost';
$DATABASE_USER='skfmis_stocktest';
$DATABASE_PASS='stocktest';
$DATABASE_NAME = 'skfmis_stocktest';
*/
/*
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'demo';
*/

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
  exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT EMPID,EMPNAME,TRCODE,password, email, ROLE FROM user_mso WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($EMPID, $EMPNAME, $TRCODE, $password, $email, $ROLE);
$stmt->fetch();
$stmt->close();
?>

<?php
//session_start();
if(!session_id() && !headers_sent()) {
   session_start();
} 

include "connection.php";
?>

<?php
// initializing variables
$EMPID                  = "";
$EMPNAME                = "";
$TRCODE                 = "";
$FMTR                   = "";
$RSMTR                  = "";
$mReporting_DRID        = "";
$mReporting_DRNAME      = "";
$Active_Status          = "";
$Touring_Doctor         = "";
$PresentPerWeek         = "";
$mReporting_SPECIALITY  = "";
$mReporting_DEGREE      = "";
$mReporting_Address     = "";
$mReporting_Thana       = "";
$mReporting_District    = "";
$mReporting_Mobile      = "";
$mReporting_NOP         = "";
$BRAND1                 = "";
$BRAND2                 = "";
$BRAND3                 = "";
$BRAND4                 = "";
$BRAND5                 = "";
$Category               = "";
$DSR_Doctor_Category    = "";
$DSR_PostGradDegree     = "";
$Doctor_Type            = "";
$Instition_Doctor_Type  = "";
$Doctor_Place_name      = "";
$Doctor_Place_road      = "";
$Doctor_Place_area      = "";
$Doctor_Place_District  = "";
$Doctor_Place_Thana     = "";
$Other_DoctorType       = "";
$DCC_Chemist            = "";
$DRID_4P                = "";
$DRNAME_4P              = "";
$Address_4P             = "";
$Specialty_4P           = "";
$DSR_DRID               = "";
$DSR_DRNAME             = "";
$DSR_Address            = "";
$NSMID                  = "";
$NSMNAME                = "";

$errors = array(); 
$_SESSION['loggedin'] = "";

$stmt = $conn->prepare('SELECT EMPID,EMPNAME,TRCODE,password, email, ROLE FROM user_mso WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($EMPID, $EMPNAME, $TRCODE, $password, $email, $ROLE);
$stmt->fetch();
$stmt->close();



if (isset($_POST['submitDoctor'])) {
  // receive all input values from the form

    $EMPID=$_SESSION['name'];
    $EMPNAME=$EMPNAME;
    $TRCODE=$TRCODE;
    $ROLE=$ROLE;
    
    $query1 = "SELECT FMTR, RSMTR, NSMID, NSMNAME FROM skf_rfieldforce WHERE MSOTR = '".$TRCODE."'";
    $result1 = mysqli_query($conn,$query1);
    $row = mysqli_fetch_array($result1);
    $FMTR = $row['FMTR'];
    $RSMTR = $row['RSMTR'];
    $NSMID = $row['NSMID'];
    $NSMNAME = $row['NSMNAME'];
    
    //get mReporting_DRID & mReporting_DRNAME
    // GET DSR INFO
    $mReportingDRInfo      = isset($_POST["mReporting_DRID"]) ? $_POST["mReporting_DRID"] : '';
  
    if(is_null($mReportingDRInfo)){
        $mReportingDRInfo      = "";
        $mReporting_DRID   = "";//GET EMPID FROM MERGE
        $mReporting_DRNAME = ""; //GET EMPNAME FROM MERGE
        $Active_Status = "";
        $Touring_Doctor = "";
        $PresentPerWeek = "";
        $mReporting_SPECIALITY  = "";
        $mReporting_DEGREE = "";
        $mReporting_Address  = "";
        $mReporting_Thana = "";
        $mReporting_District  = "";
        $mReporting_Mobile = "";
        $mReporting_NOP = "";
        $BRAND1  = "";
        $BRAND2  = "";
        $BRAND3  = "";
        $BRAND4  = "";
        $BRAND5  = "";
        $Category  = "";
        $DSR_Doctor_Category = "";
        $DSR_PostGradDegree  = "";
        $Doctor_Type = "";
        $Instition_Doctor_Type = "";
        $Doctor_Place_name = "";
        $Doctor_Place_road = "";
        $Doctor_Place_area = "";
        $Doctor_Place_District = "";
        $Doctor_Place_Thana = "";
        $Other_DoctorType = "";
        $WeekDays = "";
    }else {
        //get DSR_DRID & DSR_DRNAME
        
        $mReporting_DRID_Info  = explode("-", $mReportingDRInfo);
        $mReporting_DRID   = trim($mReporting_DRID_Info[0]); //GET EMPID FROM MERGE
        //$mReporting_DRNAME = trim($mReporting_DRID_Info[1]); //GET EMPNAME FROM MERGE
        $mReporting_DRNAME     = $_POST["mReporting_DRNAME"];
        $Active_Status         = $_POST["Active_Status"];
        $Touring_Doctor        = $_POST["Touring_Doctor"];
        
        $checkBox = implode(',', $_POST['Days']);
      //  $WeekDays              = $_POST['Days'];
    //    $chk="";  
     //   foreach($WeekDays as $chk1)  
      //  {  
    //      $chk.= $chk1.",";  
     //   } 
        
        $PresentPerWeek        = $_POST["PresentPerWeek"];
        $mReporting_SPECIALITY = $_POST["mReporting_SPECIALITY"];
        $mReporting_DEGREE     = $_POST["mReporting_DEGREE"];
        $mReporting_Address    = $_POST["mReporting_Address"];
        $mReporting_Thana      = $_POST["mReporting_Thana"];
        $mReporting_District   = $_POST["mReporting_District"];
        $mReporting_Mobile     = $_POST["mReporting_Mobile"];
        $mReporting_NOP        = $_POST["mReporting_NOP"];
        $BRAND1                = $_POST["BRAND1"];
        $BRAND2                = $_POST["BRAND2"];
        $BRAND3                = $_POST["BRAND3"];
        $BRAND4                = $_POST["BRAND4"];
        $BRAND5                = $_POST["BRAND5"];
        $Category              = $_POST["Category"];
        $DSR_Doctor_Category   = $_POST["DSR_Doctor_Category"];
        $DSR_PostGradDegree    = $_POST["DSR_PostGradDegree"];
        $Doctor_Type           = $_POST["Doctor_Type"];
        $Instition_Doctor_Type = $_POST["Instition_Doctor_Type"];
        $Doctor_Place_name     = $_POST["Doctor_Place_name"];
        $Doctor_Place_road     = $_POST["Doctor_Place_road"];
        $Doctor_Place_area     = $_POST["Doctor_Place_area"];
        $Doctor_Place_District = $_POST["Doctor_Place_District"];
        $Doctor_Place_Thana    = $_POST["Doctor_Place_Thana"];
        $Other_DoctorType      = $_POST["Other_DoctorType"];
    }
    
    //$transferFrom            = $_POST["transferFrom"];
 /*   $mReportingDRInfo      = isset($_POST["mReporting_DRID"]) ? $_POST["mReporting_DRID"] : '';
    if(is_null($mReportingDRInfo)){
        $mReportingDRInfo      = "";
        $mReporting_DRID   = "";//GET EMPID FROM MERGE
        $mReporting_DRNAME = ""; //GET EMPNAME FROM MERGE
        $mReporting_SPECIALITY  = "";
        $mReporting_DEGREE = "";
        $mReporting_Address  = "";
        $mReporting_Thana = "";
        $mReporting_District  = "";
        $mReporting_NOP = "";
        $Category  = "";
        $DSR_Doctor_Category = "";
        $DSR_PostGradDegree  = "";
        $Doctor_Type = "";
    }else {
        //get mReporting_DRID & mReporting_DRNAME & Info
      
        $mReporting_DRID_Info  = explode("-", $mReportingDRInfo);
        $mReporting_DRID   = trim($mReporting_DRID_Info[0]); //GET EMPID FROM MERGE
        $mReporting_DRNAME = trim($mReporting_DRID_Info[1]); //GET EMPNAME FROM MERGE
        $mReporting_SPECIALITY = $_POST["mReporting_SPECIALITY"];
        $mReporting_DEGREE     = $_POST["mReporting_DEGREE"];
        $mReporting_Address    = $_POST["mReporting_Address"];
        $mReporting_Thana      = $_POST["mReporting_Thana"];
        $mReporting_District   = $_POST["mReporting_District"];
        $mReporting_NOP        = $_POST["mReporting_NOP"];
        $Category              = $_POST["Category"];
        $DSR_Doctor_Category   = $_POST["DSR_Doctor_Category"];
        $DSR_PostGradDegree    = $_POST["DSR_PostGradDegree"];
        $Doctor_Type           = $_POST["Doctor_Type"];
    }*/
    //end of get mReproting DR Info
  
    //get DRID_4P & DRNAME_4P
    $DRInfo_4P      = isset($_POST["DRID_4P"]) ? $_POST["DRID_4P"] : '';
  
    if(is_null($DRInfo_4P)){
        $DRInfo_4P      = "";
        $DRID_4P   = "";//GET EMPID FROM MERGE
        $DRNAME_4P = ""; //GET EMPNAME FROM MERGE
        $Address_4P  = "";
        $Specialty_4P = "";
    }else {
      
        //get 4P_DRID & 4P_DRNAME
        $DRID_Info_4P  = explode("-", $DRInfo_4P);
        $DRID_4P   = trim($DRID_Info_4P[0]); //GET EMPID FROM MERGE
        $DRNAME_4P = trim($DRID_Info_4P[1]); //GET EMPNAME FROM MERGE
        
        if(is_null($DRID_4P)){
            $Address_4P  = "";
            $Specialty_4P = "";
        }else{
            $Address_4P = trim($DRID_Info_4P[2]); //GET 4P_ADDRESS FROM MERGE
            $Specialty_4P  = $_POST["4P_Specialty"];
        }//if(is_null($DRID_4P))
        //$Address_4P = trim($DRID_Info_4P[2]); //GET 4P_ADDRESS FROM MERGE
        //$Address_4P  = $_POST["4P_Address"];
        //$Specialty_4P  = $_POST["4P_Specialty"];
    }
    // END OF get DRID_4P & DRNAME_4P
    
    
    // GET DSR INFO
    $DSR_DRInfo      = isset($_POST["DSR_DRID"]) ? $_POST["DSR_DRID"] : '';
  
    if(is_null($DSR_DRInfo)){
        $DSR_DRInfo      = "";
        $DSR_DRID   = "";//GET DSR DRID FROM MERGE
        $DSR_DRNAME = ""; //GET DSR DRNAME FROM MERGE
        $DSR_Address  = "";
    }else {
      
        //get DSR_DRID & DSR_DRNAME
        $DSR_DRID_Info  = explode("-", $DSR_DRInfo);
        $DSR_DRID   = trim($DSR_DRID_Info[0]); //GET DSR DRID FROM MERGE
        $DSR_DRNAME = trim($DSR_DRID_Info[1]); //GET DSR DRNAME FROM MERGE
        $DSR_Address = trim($DSR_DRID_Info[2]); //GET DSR DRADDRESS FROM MERGE
        
        if(is_null($DSR_DRID)){
            $DSR_DRNAME = ""; //GET EMPNAME FROM MERGE
            $DSR_Address  = "";
        }else{
             $DSR_DRNAME = trim($DSR_DRID_Info[1]); //GET DSR DRNAME FROM MERGE
             $DSR_Address = trim($DSR_DRID_Info[2]); //GET DSR DRADDRESS FROM MERGE
        }//if(is_null($DSR_DRID))
    
        //$DSR_DRNAME = $_POST["DSR_DRNAME"];
        //$DSR_Address   = $_POST["DSR_Address"];
    }
    
    //END OF DSR DOCTOR INFO
    
     // GET DCC INFO
    $DCC_ChemistInfo      = isset($_POST["DCC_Chemist_ID"]) ? $_POST["DCC_Chemist_ID"] : '';
  
    if(is_null($DCC_ChemistInfo)){
        $DCC_ChemistInfo      = "";
        $DCC_ChemistID  = "";//GET DSR DRID FROM MERGE
        $DCC_ChemistNAME = ""; //GET DSR DRNAME FROM MERGE
        $DCC_ChemistMarket  = "";
    }else {
      
        //get DSR_DRID & DSR_DRNAME
        $DCC_CHEMID_Info  = explode("-", $DCC_ChemistInfo);
        $DCC_ChemistID   = trim($DCC_CHEMID_Info[0]); //GET DSR DRID FROM MERGE
        $DCC_ChemistNAME = trim($DCC_CHEMID_Info[1]); //GET DSR DRNAME FROM MERGE
        $DCC_ChemistMarket = trim($DCC_CHEMID_Info[2]); //GET DSR DRADDRESS FROM MERGE
        
        if(is_null($DCC_ChemistID)){
            $DCC_ChemistNAME = ""; //GET EMPNAME FROM MERGE
            $DCC_ChemistMarket  = "";
        }else{
             $DCC_ChemistNAME = trim($DCC_CHEMID_Info[1]); //GET DSR DRNAME FROM MERGE
             $DCC_ChemistMarket = trim($DCC_CHEMID_Info[2]); //GET DSR DRADDRESS FROM MERGE
        }//if(is_null($DCC_ChemistID))
    
       
    }
    
    //// END OF GET DCC INFO
  
    $to_date = date('Y-m-d H:i:s');

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($EMPID)) { array_push($errors, "EMPID is required"); }
    if (empty($EMPNAME)) { array_push($errors, "EMPNAME is required"); }
    if (empty($TRCODE)) { array_push($errors, "TRCODE is required"); }
    if (empty($mReporting_DRID)) { array_push($errors, "mReporting_DRID is required"); }
    if (empty($mReporting_DRNAME)) { array_push($errors, "mReporting_DRNAME is required"); }
    //if (empty($mReporting_SPECIALITY)) { array_push($errors, "mReporting_SPECIALITY is required"); }
    //if (empty($mReporting_DEGREE)) { array_push($errors, "mReporting_DEGREE is required"); }
    //if (empty($mReporting_Address)) { array_push($errors, "mReporting_Address is required"); }
    //if (empty($mReporting_Thana)) { array_push($errors, "mReporting_Thana is required"); }
    //if (empty($mReporting_District)) { array_push($errors, "mReporting_District is required"); }
    if (empty($mReporting_NOP)) { array_push($errors, "mReporting_NOP is required"); }
    if (empty($BRAND1)) { array_push($errors, "BRAND1 is required"); }
    if (empty($BRAND2)) { array_push($errors, "BRAND2 is required"); }
    if (empty($BRAND3)) { array_push($errors, "BRAND3 is required"); }
    if (empty($BRAND4)) { array_push($errors, "BRAND4 is required"); }
    if (empty($BRAND5)) { array_push($errors, "BRAND5 is required"); }
    if (empty($Category)) { array_push($errors, "Category is required"); }
    if (empty($Doctor_Type)) { array_push($errors, "Doctor_Type is required"); }
    if (empty($DRID_4P)) { array_push($errors, "DRID_4P is required"); }
    if (empty($DRNAME_4P)) { array_push($errors, "DRNAME_4P is required"); }
    if (empty($Address_4P)) { array_push($errors, "Address_4P is required"); }
    if (empty($Specialty_4P)) { array_push($errors, "Specialty_4P is required"); }

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    // $user_check_query = "SELECT * FROM skf_drlist WHERE mReporting_DRID='$mReporting_DRID' OR DRID_4P='$DRID_4P' LIMIT 1"; 
    $user_check_query = "SELECT * FROM skf_drlist WHERE mReporting_DRID='$mReporting_DRID' OR DRID_4P='$DRID_4P' OR DSR_DRID='$DSR_DRID' ";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
  
    if ($user) { // if user exists
        if ($user['mReporting_DRID'] === $mReporting_DRID) {
            array_push($errors, "mReporting_DRID already exists");
            // echo "hi";
        }

        
    }
    
    $query = "SELECT count(*) as allcount FROM skf_drlist WHERE mReporting_DRID='".$mReporting_DRID."'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    $allcount = $row['allcount'];

    // insert new record
    if($allcount == 0){
       // $insert_query = "INSERT INTO skf_drlist ( EMPID, EMPNAME, TRCODE, mReporting_DRID, mReporting_DRNAME, mReporting_SPECIALITY, mReporting_DEGREE, mReporting_Address, mReporting_Thana, mReporting_District, mReporting_NOP, Category, DSR_Doctor_Category, DSR_PostGradDegree, Doctor_Type, Instition_Doctor_Type, Doctor_Place_name, Doctor_Place_road, Doctor_Place_area, Doctor_Place_District, Doctor_Place_Thana, DRID_4P, DRNAME_4P, Address_4P, Specialty_4P, DSR_DRID, DSR_DRNAME, DSR_Address, TO_DATE, BRAND1, BRAND2, BRAND3, BRAND4, BRAND5, ROLE, FMTR, RSMTR, Other_DoctorType, mReporting_Mobile, NSMID, NSMNAME, CUSTOMERID, CUSTOMERNAME, MARKETNAME, UPDATED_ON, UPDATED_BY, UPDATED_BY_NAME, UPDATE_STATUS, FIELD1, FIELD2, FIELD3, FIELD4, FIELD5, ACTIVE_STATUS, Touring_Doctor, PresentPerWeek, WeekDays) 
  	//		  VALUES( '$EMPID', '$EMPNAME', '$TRCODE', '$mReporting_DRID', '$mReporting_DRNAME', '$mReporting_SPECIALITY', '$mReporting_DEGREE', '$mReporting_Address', '$mReporting_Thana', '$mReporting_District', '$mReporting_NOP', '$Category', '$DSR_Doctor_Category', '$DSR_PostGradDegree', '$Doctor_Type', '$Instition_Doctor_Type', '$Doctor_Place_name', '$Doctor_Place_road', '$Doctor_Place_area', '$Doctor_Place_District', '$Doctor_Place_Thana', '$DRID_4P', '$DRNAME_4P', '$Address_4P', '$Specialty_4P', '$DSR_DRID', '$DSR_DRNAME', '$DSR_Address', '$to_date', '$BRAND1', '$BRAND2', '$BRAND3', '$BRAND4', '$BRAND5', '$ROLE', '$FMTR', '$RSMTR', '$Other_DoctorType', '$mReporting_Mobile', '$NSMID', '$NSMNAME', '$DCC_ChemistID', '$DCC_ChemistNAME', '$DCC_ChemistMarket', '', '', '', '', '', '', '', '', '', '$Active_Status', '$Touring_Doctor', '$PresentPerWeek', '$chk')";
  			  
  		$insert_query = "INSERT INTO skf_drlist ( EMPID, EMPNAME, TRCODE, mReporting_DRID, mReporting_DRNAME, mReporting_SPECIALITY, mReporting_DEGREE, mReporting_Address, mReporting_Thana, mReporting_District, mReporting_NOP, Category, DSR_Doctor_Category, DSR_PostGradDegree, Doctor_Type, Instition_Doctor_Type, Doctor_Place_name, Doctor_Place_road, Doctor_Place_area, Doctor_Place_District, Doctor_Place_Thana, DRID_4P, DRNAME_4P, Address_4P, Specialty_4P, DSR_DRID, DSR_DRNAME, DSR_Address, TO_DATE, BRAND1, BRAND2, BRAND3, BRAND4, BRAND5, ROLE, FMTR, RSMTR, Other_DoctorType, mReporting_Mobile, NSMID, NSMNAME, CUSTOMERID, CUSTOMERNAME, MARKETNAME, UPDATED_ON, UPDATED_BY, UPDATED_BY_NAME, UPDATE_STATUS, FIELD1, FIELD2, FIELD3, FIELD4, FIELD5, ACTIVE_STATUS, Touring_Doctor, PresentPerWeek, WeekDays) 
  			  VALUES( '$EMPID', '$EMPNAME', '$TRCODE', '$mReporting_DRID', '$mReporting_DRNAME', '$mReporting_SPECIALITY', '$mReporting_DEGREE', '$mReporting_Address', '$mReporting_Thana', '$mReporting_District', '$mReporting_NOP', '$Category', '$DSR_Doctor_Category', '$DSR_PostGradDegree', '$Doctor_Type', '$Instition_Doctor_Type', '$Doctor_Place_name', '$Doctor_Place_road', '$Doctor_Place_area', '$Doctor_Place_District', '$Doctor_Place_Thana', '$DRID_4P', '$DRNAME_4P', '$Address_4P', '$Specialty_4P', '$DSR_DRID', '$DSR_DRNAME', '$DSR_Address', '$to_date', '$BRAND1', '$BRAND2', '$BRAND3', '$BRAND4', '$BRAND5', '$ROLE', '$FMTR', '$RSMTR', '$Other_DoctorType', '$mReporting_Mobile', '$NSMID', '$NSMNAME', '$DCC_ChemistID', '$DCC_ChemistNAME', '$DCC_ChemistMarket', '', '', '', '', '', '', '', '', '', '$Active_Status', '$Touring_Doctor', '$PresentPerWeek', '" . $checkBox . "')";	  
        mysqli_query($conn,$insert_query);
        
        echo "<script type='text/javascript'>
               
                    window.location='doctor_List_View.php';
                </script>";
    }else {
        //echo"ERROR: mReporting Doctor Already Inserted! ".mysqli_error($conn);
        echo "<script type='text/javascript'>alert('Insertion Failed!');
                    window.location='doctor_List_View.php';
                </script>";
    }
    
	
?>

    <script type="text/javascript"> 
        //alert('Successfully Inserted!');
       // header ("Location: doctor_List_View_20210728.php");
      
       //window.location.replace('doctor_List_View.php');
      // window.location.replace('http://skfmis.com/doctorlist/doctor_List_View.php');
    </script>      
    <?php
    
             
}else {
    //echo"ERROR: insert query failed ".mysqli_error($conn);
	//header ("Location: index1.php");
 
    mysqli_error($conn);
}


?>