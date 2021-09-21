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

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Eskayef Pharmaceuticals Ltd.</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/SKF_LOGO.png">
    <link rel="stylesheet" href="css/chosen.min.css">


       <style>
        .container {
            padding: 2rem 0rem;
        }
        h4 {
            margin: 2rem 0rem 1rem;
        }
        .table-image {
            td, th {
                vertical-align: middle;
            }
        }
        
        .responsive {
            padding: 0 6px;
            float: right;
            width: 24.99999%;
        }
        
        a:link {
            color: #03fc0f;
            background-color: transparent;
            text-decoration: none;
        }
        a:visited {
            color: white;
            background-color: transparent;
            text-decoration: none;
        }
        a:hover {
            color: red;
            background-color: transparent;
            text-decoration: underline;
        }
        a:active {
            color: yellow;
            background-color: transparent;
            text-decoration: underline;
        }
</style>
  </head>

  <body>
    <div class="page">
       <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
        <!--  <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div> -->
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.php" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><strong>Eskayef Pharmaceuticals Ltd.</strong></div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>SK+F</strong></div></a>  
                <!-- Toggle Button--> <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a> 
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <ul class="list-unstyled">
                    <!--<li><a href="doctor_index.php"> <i class="icon-home"></i>Home </a></li> -->
                   <!-- <li><a href="doctor_index_fm.php"> <img alt="Home" src="img/home.png" width="40" height="50"></a></li>
                    <li><a href="doctor_index_fm.php"> <img alt="Add New" src="img/doctor.png" width="50" height="60" ></a></li> -->
                   <!-- <li><a href="logout.php"> <i class="icon-close"></i>Log Out </a></li> -->
                    <li><a href="logout.php"><img alt="Log Out" src="img/door-key.png" width="40" height="50"></a> </li>

          </ul>

        </nav>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom" >Doctor List</h2>
            </div>
          </header><!-- Page Header-->

          <!-- Forms Section-->
          <section class="forms"> 
            <div class="container-fluid">
              <div class="row">
                <!-- Form Elements -->
                <div class="col-lg-12">
                  <div class="card">

                    <div class="card-body">

                      <!--  -->

                    <!--  <h3 class="h4">Successfully Inserted</h3>  -->
                       
                     <div>  <!-- plotted by me for class="col-sm-4" -->
                     <div>  <!-- plotted by me for class="form-group row" -->
                      
                    <?php
                    include "connection.php";
                          
                    $conn=mysqli_connect($servername,$username,$password,"$dbname");
                    if(!$conn){
                        die('Could not Connect My Sql:' .mysql_error());
                    }


                    //get records from database
                    
                    $id=1;
                    $query ="SELECT count(distinct mReporting_DRID) as TOTAL_DOCTOR_COUNT FROM skf_drlist WHERE RSMTR ='$TRCODE'   ; ";
                   

                    $result = $conn->query($query) or die( " TOTAL_DOCTOR_COUNT query failed");
                    
                    if($result->num_rows>0){ 
                        while($row = $result->fetch_assoc()){ 
                            $TOTAL_DOCTOR_COUNT = $row['TOTAL_DOCTOR_COUNT'];
                            //echo $TOTAL_DOCTOR_COUNT;
                            ?>                
                    
                    <?php $id = $id+1; } }else{ ?>
                    <tr><td colspan="5">No information found.....</td></tr>
                    <?php } ?>
                    
                        <div>
                           <!-- <button type="submit" class="btn btn-secondary">Cancel</button>  -->
                           <!-- <a href="doctor_index_fm.php"><button type="submit" name = "back" class="btn btn-primary" >Home</button></a>
                            <a href="doctor_index_fm.php"><button name='submitNewDoctor' id='submitNewDoctor' class="btn btn-primary">Add New</button></a> 
                            <a href="doctor_List_View_fm_all.php"><button name='ViewAllFMDoctor' id='ViewAllFMDoctor' class="btn btn-primary">All</button></a> -->
                            <button name='' id='' class="btn" readonly>Total Doctor Count : <?php echo $TOTAL_DOCTOR_COUNT; ?></button> 
                        </div>
                      
<!--     //////////////////LOAD DATA TABLE /////////////////////////       -->        
                   <!--     <p><span id='display'></span></p> -->

                    <div class="container" >
  <div class="row" >
    <div class="col-12">
        <div class="table-responsive" id="dynamic_content" style="height:300px"> 
             <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col" style="font-size:11px;">#</th>
            <th scope="col" style="font-size:11px;">mReporting_DRID</th>
            <th scope="col" style="font-size:11px;">mReporting_DRNAME</th>
            <th scope="col" style="font-size:11px;">BRAND1</th>
            <th scope="col" style="font-size:11px;">BRAND2</th>
            <th scope="col" style="font-size:11px;">BRAND3</th>
            <th scope="col" style="font-size:11px;">BRAND4</th>
            <th scope="col" style="font-size:11px;">BRAND5</th>
            <th scope="col" style="font-size:11px;">DSR_DRID</th>
            <th scope="col" style="font-size:11px;">DSR_DRNAME</th>
            <th scope="col" style="font-size:11px;">DSR_Address</th>
            <th scope="col" style="font-size:11px;">DRID_4P</th>
            <th scope="col" style="font-size:11px;">DRNAME_4P</th>
            <th scope="col" style="font-size:11px;">4P_Address</th>
            <th scope="col" style="font-size:11px;">Updated On</th>
            <th scope="col" style="font-size:11px;">FMTR</th>
            <th scope="col" style="font-size:11px;">MSOTR</th>
            <th scope="col" style="font-size:11px;">Status</th>
          </tr>
        </thead>
        <tbody>

                <?php

                    include "connection.php";
                    
                    $conn=mysqli_connect($servername,$username,$password,"$dbname");
                    if(!$conn){
                        die('Could not Connect My Sql:' .mysql_error());
                    }


                    //get records from database
                    
                    $id=1;
                    $query ="SELECT * FROM skf_drlist WHERE RSMTR ='$TRCODE' AND ACTIVE_STATUS= '1' ORDER BY TRCODE; ";
                   

                    $result = $conn->query($query) or die( "2ND query failed");
                    
                    if($result->num_rows>0){ 
                        while($row = $result->fetch_assoc()){ 
                                //get ASSIGN date from database
                            //$PHY_ID = $row['PHY_ID'];
                            

                            ?>                
                    <tr>
                        <td><?php echo $id; ?></td> 
                        <td style="font-size:10px;"><?php echo $row['mReporting_DRID']; ?></td>
                        <td style="font-size:10px;"><?php echo $row['mReporting_DRNAME'] ?></td>
                        <td style="font-size:10px;"><?php echo $row['BRAND1']; ?></td>
                        <td style="font-size:10px;"><?php echo $row['BRAND2']; ?></td>
                        <td style="font-size:10px;"><?php echo $row['BRAND3']; ?></td>
                        <td style="font-size:10px;"><?php echo $row['BRAND4']; ?></td>
                        <td style="font-size:10px;"><?php echo $row['BRAND5'] ?></td>
                        <td style="font-size:10px;"><?php echo $row['DSR_DRID']; ?></td>
                        <td style="font-size:10px;"><?php echo $row['DSR_DRNAME']; ?></td>
                        <td style="font-size:10px;"><?php echo $row['DSR_Address']; ?></td>
                        <td style="font-size:10px;"><?php echo $row['DRID_4P'] ?></td>
                        <td style="font-size:10px;"><?php echo $row['DRNAME_4P'] ?></td>
                        <td style="font-size:10px;"><?php echo $row['Address_4P'] ?></td>
                        <td style="font-size:10px;"><?php echo $row['TO_DATE'] ?></td>
                        <td style="font-size:10px;"><?php echo $row['FMTR'] ?></td>
                        <td style="font-size:10px;"><?php echo $row['TRCODE'] ?></td>
                        <td style="font-size:10px;"><?php echo $row['ACTIVE_STATUS'] ?></td>
                        
                    </tr> 
                    
                    <?php $id = $id+1; } }else{ ?>
                    <tr><td colspan="5">No information found.....</td></tr>
                    <?php } ?>

                </tbody>

            </table>
                      <!--   -->

                       
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-6">
                  <p>Eskayef Pharmaceuticals Ltd. &copy; 2021</p>
                </div>
                <div class="col-sm-6 text-right">
                  <p>Developed by <a href="index.php" class="external">MIS</a></p>
                  <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
   <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!--<script src="vendor/popper.js/umd/popper.min.js"> </script> -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <!--<script src="vendor/chart.js/Chart.min.js"></script>-->
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>

  </body>
</html>