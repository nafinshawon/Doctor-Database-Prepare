<?php
// Include the database connection file
include('connection.php');

if (isset($_POST['mReporting_Specialty_Id']) && !empty($_POST['mReporting_Specialty_Id'])) {
    $X = $_POST['mReporting_Specialty_Id'];
	// Fetch state name base on country id
	
	$query = 'select DISTINCT Degree from skf_speciality_degree where Specialty LIKE "%'.$X.'%"  ' ;
	//select * from skf_mreporting mReporting WHERE MSOTR ='$TRCODE' AND mReporting_DRID !='' and  not EXISTS (SELECT mReporting_DRID FROM skf_drlist where mReporting.mReporting_DRID = mReporting_DRID) order by mReporting.mReporting_DRID
	//$query = 'select DISTINCT mReporting_DRID,mReporting_DRNAME,DRADDRESS,MSOTR from skf_mreporting where MSOTR LIKE "%'.$X.'%" and  not EXISTS (SELECT mReporting_DRID FROM skf_drlist where mReporting.mReporting_DRID = mReporting_DRID) order by mReporting.mReporting_DRID ' ;
    //$query = "select DISTINCT mReporting_DRID,mReporting_DRNAME,DRADDRESS,MSOTR from skf_mreporting where MSOTR = 'SM21' and  not EXISTS (SELECT mReporting_DRID FROM skf_drlist where mReporting.mReporting_DRID = mReporting_DRID) order by mReporting.mReporting_DRID " ;
	$result = $conn->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="">Select Degree</option>'; 
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['Degree'].'">'.$row['Degree'].'</option>'; 
		}
	} else {
		echo '<option value="">Degree not available</option>'; 
	}
} 


?>