<?php
include 'config.inc.php';
include 'dataBase/reportDB.php';
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
                  <div class="card shadow p-2 mb-5 rounded" style="color:#fff; background-image: url('images/dashboard/Slanted-Gradient5.svg'); height:100%; background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <h3><b>CMU Mass Transit Queueing Management Analysis Program</b></h3>
                    <h4 style="margin-top: 2%;" class="font-thai">โปรแกรมการวิเคราะห์เพื่อจัดคิวรถขนส่งมวลชนมหาวิทยาลัยเชียงใหม่</h4>
                    <hr style="border-top: 1px solid #fff; width: 90%;">
                    <p style="margin-top: 1%; margin-bottom: 0%;" class="font-thai">รายงานสรุปผล</p>
                  </div>
                </center>
              </div>
            </div>
          </div>
          <!--============= end name system =============  -->

          <!--============= dashboard =============  -->
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-success text-white mr-2">
                <i class="mdi mdi-home"></i>
              </span>
              Report
            </h3>
          </div>
          <!--============= End dashboard =============  -->

          <!--============= show dashboard =============  -->
          <div class="row">

            <!-- =============Row2 data table ============= -->
            <div class="container-fluid font-thai" style="margin-top: 3%; width:100%; display: block; margin-left: auto; margin-right: auto;">
              <div class="row">
                <div class="col-sm-12">
                  <div class="p-3 mb-5 bg-white rounded" style="height:100%;">
                    <center>
                      <!-- <i class="fas fa-bus" style="margin-top: 3%; margin-bottom: 1%; font-size:60px; color:#6E008A; "></i> -->
                      <!-- ================================ ตารางความเร็วเฉลี่ยสาย 1 ================================-->
                      <div class="card-body font-thai">
                        <h4 align='left' class="card-title font-thai" style="font-family: 'Kanit', sans-serif !important;">ความเร็วเฉลี่ยของรถแต่ละคัน ในเส้นทางสาย 1
                        </h4>
                        <hr>
                        <p align='left' style="font-size:20px; color:#147D71;"><i class="fas fa-th-list"></i> Table</p>

                      </div>

                      <div class="container">
                        <div class="table-responsive">
                          <table id="table_id" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <td><i class="fas fa-clock" style="color:#147D71;"></i> วันที่ (day) </td>
                                <td><i class="fas fa-bus" style="color:#147D71;"></i> หมายเลขรถ (bus)</td>
                                <td><i class="fas fa-id-card-alt" style="color:#147D71;"></i> หมายเลขคนขับ (driver)</td>
                                <td><i class="fas fa-route" style="color:#147D71;"></i> หมายเลขเส้นทาง (route)</td>
                                <td><i class="fas fa-tachometer-alt" style="color:#147D71;"></i> ความเร็วรถ หน่วย เมตร/วินาที (speed)</td>
                              </tr>
                            </thead>

                            <?php
                            foreach ($result_1 as $row) {
                              echo '  
                                          <tr>  
                                            <td>' . $row['day'] . '</td>
                                            <td>' . $row["bus"] . '</td>
                                            <td>' . $row["driver"] . '</td>
                                            <td>' . $row["route"] . '</td>
                                            <td>' . $row["speed"] . '</td>
                                          </tr>  
                                          ';
                            }
                            ?>
                          </table>
                        </div>
                        <!-- <?php echo $time; ?> -->
                      </div>
                      <!-- ================================ end ตารางความเร็วเฉลี่ยสาย 1 ================================-->
                      <br><br>
                      <!-- ================================ ตารางความเร็วเฉลี่ยสาย 3 ================================-->
                      <div class="card-body font-thai">
                        <h4 align='left' class="card-title font-thai" style="font-family: 'Kanit', sans-serif !important;">ความเร็วเฉลี่ยของรถแต่ละคัน ในเส้นทางสาย 3
                         
                        </h4>
                        <hr>
                        <p align='left' style="font-size:20px; color:#147D71;"><i class="fas fa-th-list"></i> Table</p>

                      </div>

                      <div class="container">
                        <div class="table-responsive">
                          <table id="table_id2" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <td><i class="fas fa-clock" style="color:#147D71;"></i> วันที่ (day) </td>
                                <td><i class="fas fa-bus" style="color:#147D71;"></i> หมายเลขรถ (bus)</td>
                                <td><i class="fas fa-id-card-alt" style="color:#147D71;"></i> หมายเลขคนขับ (driver)</td>
                                <td><i class="fas fa-route" style="color:#147D71;"></i> หมายเลขเส้นทาง (route)</td>
                                <td><i class="fas fa-tachometer-alt" style="color:#147D71;"></i> ความเร็วรถ หน่วย เมตร/วินาที (speed)</td>
                              </tr>
                            </thead>

                            <?php
                            foreach ($result_3 as $row) {
                              echo '  
                                          <tr>  
                                            <td>' . $row['day'] . '</td>
                                            <td>' . $row["bus"] . '</td>
                                            <td>' . $row["driver"] . '</td>
                                            <td>' . $row["route"] . '</td>
                                            <td>' . $row["speed"] . '</td>
                                          </tr>  
                                          ';
                            }
                            ?>
                          </table>
                        </div>
                      </div>
                      <!-- ================================ end ตารางความเร็วเฉลี่ยสาย 3 ================================-->


                    </center>
                  </div>
                </div>
              </div>
            </div>
            <!-- =============End Row 2 data table ============= -->

          </div>
          <!--end content-wrapper -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
  </div>

  <!-- datepicker -->
  <script type="text/javascript">
    $(function() {
      $('#datetimepicker4').datetimepicker({
        format: 'L',
        language: 'th',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
      });
    });
  </script>
  <!-- end datepicker -->

  <!-- DataTable -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('#table_id').DataTable();
    });

    $(document).ready(function() {
      $('#table_id2').DataTable();
    });
    $(function() {
      $('[data-toggle="popover1"]').popover()
      $('[data-toggle="popover2"]').popover()

    })
  </script>
  <!-- End DataTable -->

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