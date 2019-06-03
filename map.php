<?php
include 'config.inc.php';
// include 'dataBase/dashboardDB.php';
$route = 1;
if (isset($_REQUEST["route"])) {
    $route = $_REQUEST["route"];
}
?>

<!DOCTYPE html>
<html lang="th">

<!-- ---------------------------head--------------------------- -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">

    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/DB_style.css">
    <link rel="stylesheet" href="css/scrolling.css">
    <!-- icon title -->
    <link rel="shortcut icon" href="images/school-bus.png" />
    <!-- icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <!-- chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="https://cdn.rawgit.com/emn178/Chart.PieceLabel.js/master/build/Chart.PieceLabel.min.js"></script>
    <!-- bootstrap datepicker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
    <!--**** Datatable ****-->
    <!--====== bootstrap 4 ======-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- data table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <!-- ============== map ============================ -->
    <style>
        #map1 {
            height: 100%;
        }

        #map3 {
            height: 100%;
        }

        html,
        body {
            /* height: 100%; */
            /* margin: 0;
        padding: 0; */
        }

        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto', 'sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }
    </style>
    <!-- ============== end map ============================ -->


</head>
<!-- ---------------------------body--------------------------- -->

<body>

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <!-- ============================ nav top ============================ -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- ----- Icon Top left ------- -->
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <!-- icon large -->
                <a class="navbar-brand brand-logo" href="dashboard.php">
                    <i style="font-size:30px;" class="fas fa-bus color-icon-text"></i>
                    <b class="color-icon-text">Transit Dashboard</b>
                </a>
                <!-- icon mini -->
                <a class="navbar-brand brand-logo-mini" href="dashboard.php">
                    <i style="font-size:30px;" class="fas fa-bus color-icon-text"></i>
                </a>
            </div>
            <!-- ------- end ---------- -->
            <!-- ------- nav Top right ------- -->
            <div class="navbar-menu-wrapper d-flex align-items-stretch">

                <ul class="navbar-nav navbar-nav-right">
                    <!-- date present -->
                    <li>
                        <a>
                            <i style="font-size:16px;" class="mdi mdi-calendar-today"></i>
                            <a style="font-size:16px;" class="font-thai" id="date"></a>
                        </a>
                    </li>
                    <!-- time present -->
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i style="font-size:22px;" class="mdi mdi-timer"></i>
                            <b style="font-size:20px;" id="time"></b>
                        </a>
                    </li>
                    <!-- fullscreen -->
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    <!-- top -->
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-format-line-spacing"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
            <!-- ------- end ------- -->
        </nav>
        <!-- ============================ end nav ============================ -->

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- ============================ nav left ============================ -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-dashboard" aria-expanded="false" aria-controls="ui-dashboard">
                            <span class="menu-title">Dashboard</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                        <div class="collapse" id="ui-dashboard">
                            <ul class="nav flex-column sub-menu font-thai">
                                <li class="nav-item"> <a class="nav-link" href="dashboard.php">ปริมาณการเลือกใช้เส้นทาง</a></li>
                                <li class="nav-item"> <a class="nav-link" href="dashboardPlace.php">เปรียบเทียบ ณ จุดจอด</a></li>
                                <li class="nav-item"> <a class="nav-link" href="classSchedule.php">สัดส่วนการใช้ <br><br>เมื่อเทียบกับตารางเรียน</a></li>
                                <li class="nav-item"> <a class="nav-link" href="map.php">แผนที่เส้นทาง</a></li>
                                <li class="nav-item"> <a class="nav-link" href="report.php">รายงานสรุปผล</a></li>

                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- ============================ end nav ============================ -->
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <!--============= name system =============  -->
                    <div class="row">
                        <div class="col-12">
                            <div style="margin-top: 1%; margin-bottom: 0%; width:100%; height:100%; display: block; margin-left: auto; margin-right: auto;">
                                <center>
                                    <div class="card shadow p-2 mb-5 rounded" style="color:#fff; background-image: url('images/dashboard/Slanted-Gradient6.svg'); height:100%; background-position: center; background-repeat: no-repeat; background-size: cover;">
                                        <h3><b>CMU Mass Transit Queueing Management Analysis Program</b></h3>
                                        <h4 style="margin-top: 2%;" class="font-thai">โปรแกรมการวิเคราะห์เพื่อจัดคิวรถขนส่งมวลชนมหาวิทยาลัยเชียงใหม่</h4>
                                        <hr style="border-top: 1px solid #fff; width: 90%;">
                                        <p style="margin-top: 1%; margin-bottom: 0%;" class="font-thai">แผนที่เส้นทาง</p>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div>
                    <!--============= end name system =============  -->


                    <!--============= map สาย 1 =============  -->
                    <div class="container-fluid font-thai" style="margin-top: 3%; width:100%; display: block; margin-left: auto; margin-right: auto;">
                        <form class="form-sample" method="post" action="#">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="p-3 mb-5 bg-white rounded" style="height:100%;">
                                        <center>
                                            <!-- <i class="fas fa-users" style="margin-top: 5%; margin-bottom: 5%; font-size:60px;  color:#FFC100; "></i> -->
                                            <img src="images/map.svg" style="margin-top: 5%; margin-bottom: 2%; height:100px; width:100px">
                                            <div class="card-body font-thai">
                                                <h4 class="card-title font-thai" style="font-family: 'Kanit', sans-serif !important;"><b>สถานีของเส้นทางรถขนส่งมวลชน</b></h4>

                                                <div style="margin-top: 1%;">
                                                    <!-- <?php echo $dayStartF; ?> -->
                                                    <button style="height: 35px;" class="btn btn-sm btn-outline-info dropdown-toggle font-thai btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">สาย <?php echo $route; ?></button>
                                                    <div class="dropdown-menu font-thai">
                                                        <input type="hidden" id="route" name="route" value="<?= $route ?>">

                                                        <a class="dropdown-item" href="map.php?route=1">สาย 1</a>
                                                        <a class="dropdown-item" href="map.php?route=3">สาย 3</a>


                                                    </div>
                                                </div>

                                                <hr>
                                                <div id="keep_route1">
                                                    <div class="alert" role="alert" style=" margin-top: 20px; background-color:#E1F5FE;">
                                                        <div align='left' style="color:#FF8F00; margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>P</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>* ลานจอดรถไฟฟ้าตรงข้ามหอหญิง 3 (จุดเริ่มปล่อยรถ)</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>I</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>อาคารกิจกรรมนักศึกษา</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>H</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>ภาควิชาสถิติ</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>D</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>ทางขึ้นศาลาธรรม</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>E</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>สนามรักบี้ฟุตบอล</b>
                                                            </div>
                                                        </div>


                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>F</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>สถานีบริการหน้ามหาวิทยาลัย</b>
                                                            </div>
                                                        </div>



                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>G</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>สำนักงานมหาวิทยาลัย </b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>C</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>คณะรัฐศาสตร์และรัฐประศาสนศาสตร์</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>B</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>ตรงข้าม อมช.</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>J</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>ตรงข้าม 7-ELEVEN</b>
                                                            </div>
                                                        </div>


                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>K</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>หอพัก 40 ปี</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>L</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>โรงจอดรถไฟฟ้า</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>M</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>ตรงข้ามหอพักสีชมพู</b>
                                                            </div>
                                                        </div>


                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>N</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>7-ELEVEN ข้างหอ 1 หญิง </b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>O</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>ตรงข้ามพอพักหญิง 2</b>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="keep_route3">
                                                    <div class="alert" role="alert" style=" margin-top: 20px; background-color:#E1F5FE;">
                                                        <div align='left' style="color:#FF8F00; margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>O</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>* ลานจอดรถไฟฟ้าหน้าหอพักนักศึกษาหญิง 3</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>B</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>สหกรณ์</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>C</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>คณะสังคมศาสตร์</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>E</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>คณะนิติศาสตร์</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>F</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>อ่างแก้ว</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>G</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>HB 6 คณะมนุษย์ศาสตร์</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>H</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>อาคารกิจกรรมนักศึกษา </b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>J</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>ทางขึ้นศาลาธรรมตรงข้ามไปรษณีย์</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>L</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>สนามรักบี้ฟุตบอล</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>I</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>สถานีบริการด้านหน้ามหาวิทยาลัย</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>K</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>สำนักงานมหาวิทยาลัย</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>M</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>คณะรัฐศาสตร์และรัฐประศาสนศาสตร์</b>
                                                            </div>
                                                        </div>

                                                        <div align='left' style="margin-top: 8px;" class="row">
                                                            <div class="col-sm col-sm-1" style="text-align: left; font-size:18px;">
                                                                <b>N</b>
                                                            </div>
                                                            <div class="col-sm col-sm-10" style="text-align: left;">
                                                                <b>ตรงข้ามอาคารกิจกรรมนักศึกษา</b>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </center>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="p-3 mb-5 bg-white rounded font-thai" style="height:100%;">

                                        <br>
                                        <h4 class="font-thai">แผนที่เส้นทางสาย <?php echo $route; ?></h4>
                                        <hr>
                                        <br>
                                        <!-- ====================== map ======================-->
                                        <div style="height: 760px;">
                                            <div id="map3"></div>
                                        </div>
                                        <!-- ======================end map  ======================-->

                                        <script>
                                            var route = <?php echo $route; ?>
                                            // ไม่แสดงสาย 3
                                            if (route == '3') {
                                                document.getElementById("keep_route1").style.display = "none";
                                            }
                                            // ไม่แสดงสาย 1
                                            else {
                                                document.getElementById("keep_route3").style.display = "none";
                                            }


                                            function initMap() {

                                                if (route == '3') {
                                                    var directionsService = new google.maps.DirectionsService;
                                                    var directionsDisplay = new google.maps.DirectionsRenderer({
                                                        polylineOptions: {
                                                            strokeColor: "rgb(231, 76, 60,0.45)",
                                                            strokeWeight : 6
                                                        },
                                      
                                                    });
                                                    var map = new google.maps.Map(document.getElementById('map3'), {
                                                        zoom: 17,
                                                        center: {
                                                            lat: 18.799418,
                                                            lng: 98.952322
                                                        }


                                                    });

                                                    directionsDisplay.setMap(map);

                                                    var waypts = [];


                                                    stop = new google.maps.LatLng(18.801661, 98.951243)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    stop = new google.maps.LatLng(18.803274, 98.949694)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    stop = new google.maps.LatLng(18.804427, 98.948217)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    stop = new google.maps.LatLng(18.804427, 98.948217)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    stop = new google.maps.LatLng(18.805156, 98.950074)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    stop = new google.maps.LatLng(18.804537, 98.951685)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    // ตำแหน่งตึก
                                                    stop = new google.maps.LatLng(18.804029, 98.952747)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    stop = new google.maps.LatLng(18.807736, 98.954696)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    stop = new google.maps.LatLng(18.804392, 98.953979)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    stop = new google.maps.LatLng(18.804879, 98.954378)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    stop = new google.maps.LatLng(18.806251, 98.955655)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    stop = new google.maps.LatLng(18.802849, 98.954344)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    stop = new google.maps.LatLng(18.800343, 98.953409)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                } else {

                                                    var directionsService = new google.maps.DirectionsService;
                                                    var directionsDisplay = new google.maps.DirectionsRenderer({
                                                        polylineOptions: {
                                                            strokeColor: "rgb(88, 214, 141,1)",
                                                            strokeWeight : 6
                                                        },
                                      
                                                    });
                                                    // ลานจอดรถไฟฟ้าตรงข้ามหอพักหญิง 3 (1) P
                                                    var map = new google.maps.Map(document.getElementById('map3'), {
                                                        zoom: 17,
                                                        center: {
                                                            lat: 18.799418,
                                                            lng: 98.952322
                                                        }
                                                    });

                                                    directionsDisplay.setMap(map);

                                                    var waypts = [];

                                                    // อาคารกิจกรรมนักศึกษา (2) I
                                                    stop = new google.maps.LatLng(18.8002555, 98.9533655)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true,

                                                    });
                                                    // ภาควิชาสถิติ (3) H
                                                    stop = new google.maps.LatLng(18.8029484, 98.9543339)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    // ทางขึ้นศาลาธรรม (4) D
                                                    stop = new google.maps.LatLng(18.8043694, 98.9539945)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    // สนามรักบี้ฟุตบอล (5) E
                                                    stop = new google.maps.LatLng(18.8062635, 98.9556208)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    // สถานีบริการหน้ามหาวิทยาลัย (6) F
                                                    stop = new google.maps.LatLng(18.807472, 98.9551538)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    // สำนักงานมหาวิทยาลัย (7) G
                                                    stop = new google.maps.LatLng(18.8048495, 98.954305)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true,
                                                    });

                                                    // คณะรัฐศาสตร์และรัฐประศาสนศาสตร์ (8) C
                                                    stop = new google.maps.LatLng(18.8027566, 98.9543501)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    // ตรงข้าม อมช. (9) B
                                                    stop = new google.maps.LatLng(18.8003454, 98.9533977)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    // ตรงข้าม 7-ELEVEN (10) J
                                                    stop = new google.maps.LatLng(18.79952, 98.95586)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    // หอพัก 40 ปี (11) K
                                                    stop = new google.maps.LatLng(18.7987118, 98.958616)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true,

                                                    });

                                                    // โรงจอดรถไฟฟ้า (12) L
                                                    stop = new google.maps.LatLng(18.79695, 98.96009)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });
                                                    // ตรงข้ามหอพักสีชมพู (13) M
                                                    stop = new google.maps.LatLng(18.7988907, 98.9574973)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    // 7-ELEVEN ข้างหอ 1 หญิง (14) N
                                                    stop = new google.maps.LatLng(18.7995336, 98.9561668)
                                                    waypts.push({
                                                        location: stop,
                                                        stopover: true
                                                    });

                                                    // ตรงข้ามพอพักหญิง 2 (15)  O
                                                    stop = new google.maps.LatLng(18.7995396, 98.9539555)
                                                    // stop.setContent("toy");
                                                    waypts.push({
                                                        location: stop,
                                                        // description: 'Alibaug is a coastal town and a municipal council in Raigad District in the Konkan region of Maharashtra, India.',
                                                        stopover: true

                                                    });
                                                }


                                                calculateAndDisplayRoute(directionsService, directionsDisplay, waypts);
                                            }

                                            function calculateAndDisplayRoute(directionsService, directionsDisplay, waypts) {
                                                directionsService.route({
                                                    origin: {
                                                        lat: 18.799418,
                                                        lng: 98.952322
                                                    }, // จุด start 18.7994182212734, 98.952321875
                                                    destination: {
                                                        lat: 18.799418,
                                                        lng: 98.952322
                                                    }, // จุดจบคือ ที่จุด start
                                                    waypoints: waypts,
                                                    travelMode: 'DRIVING'

                                                }, function(response, status) {
                                                    if (status === 'OK') {

                                                        directionsDisplay.setDirections(response);

                                                    } else {
                                                        window.alert('Directions request failed due to ' + status);
                                                    }
                                                });

                                            }
                                        </script>
                                    </div>

                                </div>




                            </div>
                        </form>
                    </div>
                    <!--=============End map =============  -->
                    <!--end content-wrapper -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
    </div>

    <!-- ======================= map ===================== -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6_s1weKmvxVfRh21rQZYCKSMOuYh3ZCU&callback=initMap">
    </script>
    <!-- ======================= End map ===================== -->


    <!-- plugins:js -->
    <!-- ปิดไว้เพราะ ถ้าเปิดเเล้ว data table ไม่ขึ้นน่าจะมีอะไรที่ตีกัน -->
    <!-- <script src="vendors/js/vendor.bundle.base.js"></script> -->
    <script src="vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
</body>
<!-- ============= script ============= -->
<script type="text/javascript" src="vendors/js/classSchedule.js"></script>
<!-- ============= end script ============= -->

</html>