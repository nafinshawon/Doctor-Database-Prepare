<?php
// Include the database connection file
include('connection.php');

if (isset($_POST['DISTRICTId']) && !empty($_POST['DISTRICTId'])) {
    $X = $_POST['DISTRICTId'];
	// Fetch state name base on country id
	
	$query = 'select * from skf_thana where DIST LIKE "%'.$X.'%"  ' ;
	//select * from skf_mreporting mReporting WHERE MSOTR ='$TRCODE' AND mReporting_DRID !='' and  not EXISTS (SELECT mReporting_DRID FROM skf_drlist where mReporting.mReporting_DRID = mReporting_DRID) order by mReporting.mReporting_DRID
	//$query = 'select DISTINCT mReporting_DRID,mReporting_DRNAME,DRADDRESS,MSOTR from skf_mreporting where MSOTR LIKE "%'.$X.'%" and  not EXISTS (SELECT mReporting_DRID FROM skf_drlist where mReporting.mReporting_DRID = mReporting_DRID) order by mReporting.mReporting_DRID ' ;
    //$query = "select DISTINCT mReporting_DRID,mReporting_DRNAME,DRADDRESS,MSOTR from skf_mreporting where MSOTR = 'SM21' and  not EXISTS (SELECT mReporting_DRID FROM skf_drlist where mReporting.mReporting_DRID = mReporting_DRID) order by mReporting.mReporting_DRID " ;
	$result = $conn->query($query);

	if ($result->num_rows > 0) {
		echo '<option value="">Select Thana</option>'; 
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['Thana'].'">'.$row['Thana'].'</option>'; 
		}
	} else {
		echo '<option value="">Thana not available</option>'; 
	}
} 


?>