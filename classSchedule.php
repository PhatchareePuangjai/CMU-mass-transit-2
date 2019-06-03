<?php
include 'config.inc.php';
include 'dataBase/classScheduleDB.php';
// include 'dataBase/classScheduleDB_v2.php';
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
                  <div class="card shadow p-2 mb-5 rounded" style="color:#fff; background-image: url('images/dashboard/Slanted-Gradient4.svg'); height:100%; background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <h3><b>CMU Mass Transit Queueing Management Analysis Program</b></h3>
                    <h4 style="margin-top: 2%;" class="font-thai">โปรแกรมการวิเคราะห์เพื่อจัดคิวรถขนส่งมวลชนมหาวิทยาลัยเชียงใหม่</h4>
                    <hr style="border-top: 1px solid #fff; width: 90%;">
                    <p style="margin-top: 1%; margin-bottom: 0%;" class="font-thai">วิเคราะห์ข้อมูลรถขนส่งมวลชนเส้นทางสาย 1 และสาย 3 เปรียบเทียบกับข้อมูลตารางเรียนของนักศึกษา</p>
                  </div>
                </center>
              </div>
            </div>
          </div>
          <!--============= end name system =============  -->
          <!--============= select with show dashboard =============  -->
          <div class="grid-margin stretch-card">
            <div class="card">
              <div class="shadow card-body" style="width: 100%;">
                <form class="form-sample" method="post" action="#">
                  <!-- select building -->
                  <div class="row">
                    <div class="col">

                      <button style="height: 40px; font-size: 16px" class="btn btn-sm btn-outline-danger dropdown-toggle font-thai btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $building; ?></button>
                      <div class="dropdown-menu font-thai">
                        <input type="hidden" id="building" name="building" value="<?= $building ?>">
                        <a class="dropdown-item" href="classSchedule.php?building=อาคารภาควิชาวิทยาการคอมพิวเตอร์">อาคารภาควิชาวิทยาการคอมพิวเตอร์ </a>
                        <a class="dropdown-item" href="classSchedule.php?building=อาคารรัฐศาสตร์">อาคารรัฐศาสตร์ </a>
                      </div>
                    </div>
                    <!-- end select building -->
                    <!-- select route -->
                    <div class="col">
                      <div class="row form-group font-thai" style="margin-top: 0px; margin-bottom: 0px;">
                        <label class="col-6 col-form-label" style="font-size: 18px"><b>เส้นทางสาย:</b></label>
                        <div class="col-sm-3">
                          <div class="form-check form-check-danger">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="route_1" id="route_1" value="1" <?php echo ($route_1 == '1' ? 'checked' : ''); ?> <?php echo ($disabled_1 == true ? 'disabled' : ''); ?>>
                              1
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check form-check-danger">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="route_3" id="route_3" value="3" <?php echo ($route_3 == '3' ? 'checked' : ''); ?> <?php echo ($disabled_3 == true ? 'disabled' : ''); ?>>
                              3
                            </label>
                          </div>
                        </div>
                      </div>

                    </div>
                    <!-- end select route -->
                    <!-- select semester -->
                    <div class="col">
                      <div class="row form-group font-thai" style="margin-top: 0px; margin-bottom: 0px;">
                        <label class="col-6 col-form-label" style="font-size: 18px"><b>ปีการศึกษา:</b></label>
                        <div class="col-sm-3">
                          <div class="form-check form-check-danger ">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="semester" id="semester_1" value="1" <?php echo ($semester == '1' ? 'checked' : ''); ?>>
                              1
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check form-check-danger">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="semester" id="semester_2" value="2" <?php echo ($semester == '2' ? 'checked' : ''); ?>>

                              2
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end select semester -->
                    <!-- button show -->
                    <div class="col">
                      <button name="show" value="show" type="submit" class="btn btn-gradient-danger btn-rounded btn-fw font-thai">ค้นหา</button>
                    </div>
                    <!-- end button show -->
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!--============= end select with show dashboard =============  -->
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-danger text-white mr-2">
                <i class="mdi mdi-home"></i>
              </span>
              Dashboard
            </h3>
          </div>
          <div class="row">
            <!-- =============Row1 Grid Chart line ============= -->
            <div class="container-fluid font-thai" style="margin-top: 1%; width:100%; display: block; margin-left: auto; margin-right: auto;">
              <div class="row">
                <div class="col-sm-4">
                  <div class="p-3 mb-5 bg-white rounded" style="height:100%;">
                    <center>
                      <i class="fas fa-users" style="margin-top: 5%; margin-bottom: 5%; font-size:60px; color:#EE5300; "></i>
                      <div class="card-body font-thai">
                        <h4 class="card-title font-thai" style="font-family: 'Kanit', sans-serif !important;">จำนวนนักศึกษาที่เรียนใน<?php echo $building; ?> แต่ละวัน</h4>
                        <hr>
                        <p align='left' style="font-size:20px; color:#EE5300;"><i class="fas fa-chart-pie"></i> doughnut</p>
                        <!-- ============= chart ============= -->
                        <div class="chart-container">
                          <!-- <?php echo $total_num_keep ?> -->

                          <canvas id="myChart1"></canvas>
                          <script>
                            var ctx = document.getElementById("myChart1").getContext('2d');
                            // color
                            var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 50);
                            gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
                            gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');
                            // ======= data =========
                            var data = {
                              labels: [<?php echo $day_ ?>],
                              datasets: [{
                                  data: [<?php echo $total_num_keep; ?>],
                                  backgroundColor: [
                                    'rgb(251, 232, 102 , 0.55)',
                                    'rgb(255, 99, 132, 0.45)',
                                    'rgb(72, 201, 176, 0.55)',
                                    'rgb(235, 152, 78, 0.55)',
                                    'rgb(133, 193, 233, 0.55)',
                                    'rgb(210, 180, 222, 0.55)',
                                    'rgb(255, 79, 79, 0.70)',
                                  ],
                                  // borderColor: [
                                  //   'rgb(212, 172, 13, 0.55)',
                                  //   'rgb(212, 22, 180, 0.55)',
                                  //   'rgb(14, 98, 81, 0.55)',
                                  //   'rgb(175, 96, 26, 0.55)',
                                  //   'rgb(40, 116, 166, 0.55)',
                                  //   'rgb(108, 52, 131, 0.55)',
                                  //   'rgb(123, 36, 28, 0.55)',
                                  // ],
                                }

                              ]
                            }
                            var doughnutPieOptions = {
                              responsive: true,
                              animation: {
                                animateScale: true,
                                animateRotate: true
                              }
                            };

                            // ======= chart =========
                            var myChart = new Chart(ctx, {
                              type: 'doughnut',
                              data: data,
                              options: doughnutPieOptions
                            });
                          </script>
                        </div>
                      </div>
                    </center>
                  </div>
                </div>
                <div class="col-sm-8">
                  <div class="p-3 mb-5 bg-white rounded font-thai" style="height:100%;">
                    <br>
                    <h4 class="font-thai">จำนวนนักศึกษาที่เรียนใน<?php echo $building; ?> แต่ละช่วงเวลา
                      <br>
                      <span class="badge badge-danger font-thai" data-toggle="popover1" title="กราฟแสดงจำนวนนักศึกษา" data-content="แสดงจำนวนนักศึกษาที่เดินทางมาเรียนในอาคาร ในเเต่ละช่วงเวลา ของแต่ละวัน">รายละเอียดเพิ่มเติม</span>
                    </h4>
                    <hr>
                    <p style="font-size:20px; color:#EE5300;"><i class="fas fa-chart-line"></i> Line</p>

                    <!-- ============= chart ============= -->
                    <div class="chart-container">
                      <canvas id="myChart2" style="width:300px; height:380px;"></canvas>
                      <script>
                        var ctx = document.getElementById('myChart2').getContext('2d');
                        var chart = new Chart(ctx, {
                          type: 'line',
                          data: {
                            labels: [<?php echo $time_chart; ?>],
                            datasets: [{
                                label: "วันจันทร์",
                                backgroundColor: 'rgb(251, 232, 102 , 0.55)',
                                borderColor: 'rgb(212, 172, 13, 0.55)',
                                data: [<?php echo $numStudents_Mo; ?>],
                              },
                              {
                                label: "วันอังคาร",
                                backgroundColor: 'rgb(255, 99, 132, 0.55)',
                                borderColor: 'rgb(212, 22, 180, 0.55)',
                                data: [<?php echo $numStudents_Tu; ?>],
                              },
                              {
                                label: "วันพุธ",
                                backgroundColor: 'rgb(72, 201, 176, 0.55)',
                                borderColor: 'rgb(14, 98, 81, 0.55)',
                                data: [<?php echo $numStudents_We; ?>],
                              },
                              {
                                label: "วันพฤหัสบดี",
                                backgroundColor: 'rgb(235, 152, 78, 0.55)',
                                borderColor: 'rgb(175, 96, 26, 0.55)',
                                data: [<?php echo $numStudents_Th; ?>],
                              },
                              {
                                label: "วันศุกร์",
                                backgroundColor: 'rgb(133, 193, 233, 0.55)',
                                borderColor: 'rgb(40, 116, 166, 0.55)',
                                data: [<?php echo $numStudents_Fr; ?>],
                              },
                              {
                                label: "วันเสาร์",
                                backgroundColor: 'rgb(210, 180, 222, 0.55)',
                                borderColor: 'rgb(108, 52, 131, 0.55)',
                                data: [<?php echo $numStudents_Sa; ?>],
                              },
                              {
                                label: "วันอาทิตย์",
                                backgroundColor: 'rgb(255, 79, 79, 0.55)',
                                borderColor: 'rgb(123, 36, 28, 0.55)',
                                data: [<?php echo $numStudents_Su; ?>],
                              }
                            ]
                          },
                          options: {
                            "hover": {
                              "animationDuration": 0
                            },
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                              "display": true
                            },
                            elements: {
                              line: {
                                fill: false
                              }
                            },
                            scales: {
                              yAxes: [{
                                scaleLabel: {
                                  display: true,
                                  labelString: 'จำนวนนักศึกษา'
                                }
                              }],
                              xAxes: [{
                                scaleLabel: {
                                  display: true,
                                  labelString: 'ช่วงเวลาที่มีนักศึกษาเรียนใน<?php echo $building; ?>'
                                }
                              }]

                            }
                          }
                        });
                      </script>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- =============End Row1 Grid Chart line ============= -->


            <!-- =============Row2 Grid Char and calculate ============= -->
            <div class="container-fluid font-thai" style="margin-top: 3%; width:100%; display: block; margin-left: auto; margin-right: auto;">
              <form class="form-sample" method="post" action="#">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="p-3 mb-5 bg-white rounded" style="height:100%;">
                      <center>
                        <!-- <i class="fas fa-users" style="margin-top: 5%; margin-bottom: 5%; font-size:60px;  color:#FFC100; "></i> -->
                        <img src="images/logistics.svg" style="margin-top: 5%; margin-bottom: 2%; height:100px; width:100px">
                        <div class="card-body font-thai">
                          <h4 class="card-title font-thai" style="font-family: 'Kanit', sans-serif !important;"><b>คำนวณ</b></h4>
                          <h5 class="card-title font-thai" style="font-family: 'Kanit', sans-serif !important;">ช่วงเวลา <?php echo $time_star1[$time_index] . ' - ' . $time_end1[$time_index]; ?></h5>

                          <hr>
                          <!--=========== select route ===========-->
                          <div class="row form-group font-thai" style="margin-top: 0px; margin-bottom: 0px;">
                            <div class="col-sm-6 col-form-label">
                              <h5 align='left' style="font-family: 'Kanit', sans-serif !important;"><b>เลือกเส้นทาง:</b></h5>
                            </div>
                            <div class="col">
                              <div class="form-check form-check-danger">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="route_cal" id="route_1" value="1" <?php echo ($route_cal == '1' ? 'checked' : ''); ?> <?php echo ($building == "อาคารภาควิชาวิทยาการคอมพิวเตอร์" ? 'disabled' : ''); ?>>
                                  1
                                </label>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-check form-check-danger">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="route_cal" id="route_3" value="3" <?php echo ($route_cal == '3' ? 'checked' : ''); ?> <?php echo ($building == "อาคารภาควิชาวิทยาการคอมพิวเตอร์" ? 'disabled' : ''); ?>>
                                  3
                                </label>
                              </div>
                            </div>
                          </div>
                          <!--=========== select route =========== -->
                          <hr>

                          <!--======================================== Calculate 1 ============================================-->
                          <p align='left' style="font-size:16; color:#EE5300;"><i class="fas fa-calculator"></i> คำนวณเวลาในการเริ่มปล่อยคิวรถ</p>


                          <!-- ===========  select time =========== -->
                          <div class="row form-group font-thai" style="margin-top: 0px; margin-bottom: 0px;">
                            <div class="col col-form-label">
                              <h5 align='left' style="font-family: 'Kanit', sans-serif !important;"><b>เลือกเวลาที่ต้องการให้รถถึงจุดหมาย:</b></h5>
                            </div>
                          </div>

                          <div class="row font-thai">
                            <div class="col">
                              <div class="input-group date" id="datetimepicker5" data-link-format="HH.mm" data-date-format="HH.mm" data-target-input="nearest">
                                <input type="text" name="time_cal" id="time_cal" style="font-size:16px; height:42px;" value="<?= $time_cal ?>" class="form-control datetimepicker-input" data-target="#datetimepicker5" />
                                <div class="input-group-append" style="font-size:16px; height:42px;" data-target="#datetimepicker5" data-toggle="datetimepicker">
                                  <div class="input-group-text  btn btn-gradient-danger"><i style="color:#ffffff;" class="fas fa-clock"></i></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--=========== End select time ===========-->
                          <div class="row font-thai" style="margin-top: 20px; margin-bottom: 0px;">
                            <div class="col">
                              <button name="cal" style="width:100%;" value="cal" type="submit" class="btn btn-gradient-danger btn-rounded btn-fw font-thai">คำนวณเวลาในการเริ่มปล่อยคิวรถ</button>
                            </div>
                          </div>


                          <!-- show ans -->
                          <br>
                          <!-- <?php
                                // echo "เวลาที่เลือกคำนวณ: ". $time_cal;
                                // echo "<br>";
                                // echo "เวลาที่ใช้เดินทาง: " .$time_diff; 
                                // echo "<br>";
                                echo "เวลาในการเริ่มปล่อยคิวรถ: " . $time_start;
                                // ****** รอดูวันพนอีกที ******** 
                                // echo "<br>";
                                // echo "time_start" . strtotime($time_start);
                                // echo "<br>";
                                // echo  "time_P" . strtotime($time_P);

                                ?> -->

                          <table class="table table-striped">
                            <tbody>
                              <tr>
                                <td style="font-size: 14px;">
                                  <i style="color:#EE5300;" class="fas fa-clock"></i> เวลาในการเริ่มปล่อยคิวรถ:
                                </td>
                                <td><label class="badge badge-danger font-thai" style="font-size: 16px; height:44px; width:100%;"><?php echo $time_start; ?>
                                    <br>
                                    <p style="font-size: 10px;">(ชั่วโมง:นาที)<p>
                                  </label></td>
                              </tr>

                            </tbody>
                          </table>


                          <!-- alert เมื่อเวลาไม่ถูกต้อง -->
                          <div class="row">
                            <div id="alerttime" class="col" style="text-align: left; font-size:80%; margin-top: 20px;">
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-bell" style="font-size:15px;"></i>
                                ไม่สามารถเดินทางไปถึงจุดหมายตามเวลาที่ต้องการได้ กรุณาเลือกเวลาใหม่
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                            </div>
                          </div>
                          <!-- end alert -->
                          <!-- end show ans -->
                          <!--======================================== End Calculate 1 ============================================-->
                          <br>
                          <!--======================================== Calculate 2 ============================================-->
                          <hr>
                          <p align='left' style="font-size:16; color:#EE5300;"><i class="fas fa-calculator"></i> คำนวณระยะห่างของเวลา ในการปล่อยคิวรถครั้งต่อไป</p>

                          <!-- ===========  input num student =========== -->
                          <div class="row form-group font-thai" style="margin-top: 0px; margin-bottom: 0px;">
                            <div class="col col-form-label">
                              <h6 align='left' style="font-family: 'Kanit', sans-serif !important;"><b>จำนวนนักศึกษาที่ต้องการให้ถึง<?php echo $building; ?>:</b></h6>
                            </div>
                          </div>

                          <div class="row font-thai">
                            <div class="col">
                              <div class="form-group form-control-sm">
                                <input type="text" style="font-size:16px; height:42px; font-family: 'Kanit', sans-serif !important;" class="form-control" value="<?= $numStudent ?>" name="numStudent" id="numStudent" placeholder="จำนวนนักศึกษา">
                              </div>
                            </div>
                          </div>
                          <!--=========== End input num student ===========-->


                          <!-- ===========  select time =========== -->
                          <div class="row form-group font-thai" style="margin-top: 0px; margin-bottom: 0px;">
                            <div class="col col-form-label">
                              <h5 align='left' style="font-family: 'Kanit', sans-serif !important;"><b>ภายในระยะเวลา:</b></h5>
                            </div>
                          </div>

                          <div class="row font-thai">
                            <div class="col">
                              <div class="input-group date" id="datetimepicker6" data-link-format="HH:mm" data-date-format="HH:mm" data-target-input="nearest">
                                <input type="text" name="time_q" id="time_q" style="font-size:16px; height:42px;" value="<?= $time_q ?>" class="form-control datetimepicker-input" data-target="#datetimepicker6" />
                                <div class="input-group-append" style="font-size:16px; height:42px;" data-target="#datetimepicker6" data-toggle="datetimepicker">
                                  <div class="input-group-text  btn btn-gradient-danger"><i style="color:#ffffff;" class="fas fa-clock"></i></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--=========== End select time ===========-->
                          <div class="row font-thai" style="margin-top: 20px; margin-bottom: 0px;">
                            <div class="col">
                              <button name="cal2" style="width:100%;" value="cal2" type="submit" class="btn btn-gradient-danger btn-rounded btn-fw font-thai">คำนวณ</button>
                            </div>
                          </div>
                          <br>
                          <!-- show ans -->
                          <table class="table table-striped">
                            <tbody>
                              <tr>
                                <td style="font-size: 14px;">
                                  <i style="color:#EE5300;" class="fas fa-bus"></i> จำนวนรถที่จะเพียงพอต่อนักศึกษาอย่างน้อย:
                                </td>
                                <td><label class="badge badge-danger font-thai" style="font-size: 16px; height:44px; width:100%;"><?php echo ceil($numBus); ?>
                                    <br>
                                    <p style="font-size: 10px;">คัน<p>
                                  </label></td>
                              </tr>
                              <tr>
                                <td style="font-size: 14px;">
                                  <i style="color:#EE5300;" class="fas fa-clock"></i> เวลาในการเริ่มปล่อยคิวรถ:
                                </td>
                                <td><label class="badge badge-danger font-thai" style="font-size: 16px; height:44px; width:100%;"><?php echo $time_start2; ?>
                                    <br>
                                    <p style="font-size: 10px;">(ชั่วโมง:นาที)<p>
                                  </label></td>
                              </tr>
                              <tr>
                                <td style="font-size: 14px;">
                                  <i style="color:#EE5300;" class="fas fa-history"></i> ระยะห่างของเวลา ในการปล่อยคิวรถครั้งต่อไปในทุกๆ:
                                </td>
                                <td><label class="badge badge-danger font-thai" style="font-size: 16px; height:44px; width:100%;"><?php echo $hour . ' : ' . $minute . ' : ' . $second; ?>
                                    <br>
                                    <p style="font-size: 10px;">(ชั่วโมง : นาที : วินาที)</p>
                                  </label>
                                </td>
                              </tr>

                            </tbody>
                          </table>

                          <!-- <?php

                                echo "เวลาในการเริ่มปล่อยคิวรถ: " . $time_start2;
                                echo "<br>";
                                echo "ระยะห่างของเวลา ในการปล่อยคิวรถครั้งต่อไปในทุกๆ: " .  $hour . ' : ' . $minute . ' : ' . $second  . " (ชั่วโมง : นาที : วินาที)";

                                ?> -->
                          <!-- end show ans -->

                          <!--======================================== End Calculate 2 ============================================-->


                        </div>
                      </center>
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <div class="p-3 mb-5 bg-white rounded font-thai" style="height:100%;">
                      <br>
                      <h4 class="font-thai">เวลาเฉลี่ยในการเดินทางไปยัง<?php echo $building; ?> ในแต่ละช่วงเวลาของทุก<?php echo $daySelect_thai ?>
                        <br>
                        <span class="badge badge-danger font-thai" data-toggle="popover2" title="กราฟแสดงเวลาเฉลี่ยในการเดินทาง" data-content="แสดงเวลาเฉลี่ยในการเดินทางไปยังปลายทาง ว่าในเเต่ละช่วงเวลาของวันที่ทำการค้นหา ใช้เวลาเฉลี่ยเท่าไหร่">รายละเอียดเพิ่มเติม</span>
                      </h4>
                      <hr>

                      <div class="row">
                        <div class="col-sm-2">
                          <p style="font-size:20px; color:#EE5300;"><i class="fas fa-chart-bar"></i> Bar</p>
                        </div>
                        <div class="col">
                          <button style="height: 35px;" class="btn btn-sm btn-outline-danger dropdown-toggle font-thai btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $daySelect_thai; ?></button>
                          <div class="dropdown-menu font-thai">
                            <input type="hidden" id="daySelect_thai" name="daySelect_thai" value="<?= $daySelect_thai ?>">
                            <a class="dropdown-item" href="classSchedule.php?daySelect_thai=วันจันทร์">วันจันทร์ </a>
                            <a class="dropdown-item" href="classSchedule.php?daySelect_thai=วันอังคาร">วันอังคาร </a>
                            <a class="dropdown-item" href="classSchedule.php?daySelect_thai=วันพุธ">วันพุธ </a>
                            <a class="dropdown-item" href="classSchedule.php?daySelect_thai=วันพฤหัสบดี">วันพฤหัสบดี </a>
                            <a class="dropdown-item" href="classSchedule.php?daySelect_thai=วันศุกร์">วันศุกร์ </a>
                            <a class="dropdown-item" href="classSchedule.php?daySelect_thai=วันเสาร์">วันเสาร์ </a>
                            <a class="dropdown-item" href="classSchedule.php?daySelect_thai=วันอาทิตย์">วันอาทิตย์ </a>
                          </div>
                        </div>
                        <nav aria-label="breadcrumb">
                          <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                              <span></span><a href="M2_chartBarTime.php?building=<?= $building ?>" style="color:#444;">รายละเอียดเพิ่มเติม</a>
                              <i class="mdi mdi-alert-circle-outline icon-sm text-danger align-middle"></i>
                            </li>
                          </ul>
                        </nav>

                      </div>

                      <!-- ==============chart 1 ============= -->

                      <div class="chart-container">
                        <canvas id="myChart3" style="width:450px; height:400px;"></canvas>
                        <script>
                          var ctx = document.getElementById("myChart3").getContext('2d');
                          debugger;
                          // ======= data =========
                          var data = {
                            labels: [<?php echo $timeBus_avg; ?>],
                            datasets: [

                              {
                                label: "สาย 1",
                                backgroundColor: 'rgb(88, 214, 141,0.25)',
                                borderColor: 'rgb(88, 214, 141,0.80)',
                                data: [<?= $timeBus_avg_1_s; ?>],
                              },
                              {
                                label: "สาย 3",
                                backgroundColor: 'rgb(231, 76, 60,0.25)',
                                borderColor: 'rgb(231, 76, 60,0.55)',
                                data: [<?= $timeBus_avg_3_s; ?>],
                              }
                            ]
                          }
                          // ======= chart =========
                          var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: data,
                            options: {
                              "hover": {
                                "animationDuration": 0
                              },
                              "animation": {
                                "duration": 1,
                                "onComplete": function() {
                                  var chartInstance = this.chart,
                                    ctx = chartInstance.ctx;

                                  ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                                  ctx.textAlign = 'center';
                                  ctx.textBaseline = 'bottom';

                                  this.data.datasets.forEach(function(dataset, i) {
                                    var meta = chartInstance.controller.getDatasetMeta(i);
                                    meta.data.forEach(function(bar, index) {
                                      var data = dataset.data[index];
                                      ctx.fillStyle = '#444';
                                      ctx.fillText(data, bar._model.x, bar._model.y);

                                    });
                                  });
                                }
                              },
                              responsive: true,
                              maintainAspectRatio: false,
                              legend: {
                                "display": true
                              },
                              scales: {
                                yAxes: [{
                                  ticks: {
                                    beginAtZero: true,
                                    // max: Math.max(...data.datasets[0].data) + 10,
                                  },
                                  scaleLabel: {
                                    display: true,
                                    labelString: 'เวลาเฉลี่ยในการเดินทางไปยังอาคาร (นาที)'
                                  }
                                }],
                                xAxes: [{
                                  scaleLabel: {
                                    display: true,
                                    labelString: 'ช่วงเวลา (ชั่วโมง:นาที)'
                                  }
                                }]
                              }
                            }
                          });
                        </script>

                      </div>
                      <!--==============End chart 1  ==============-->

                      <br>
                      <!-- <?php echo $timeBus_avg_3[2]; ?> -->
                      <!--============== chart 2  ==============-->
                      <h4 class="font-thai">จำนวนนักศึกษาตามเวลาเริ่มและเลิกเรียนใน <?php echo $building; ?> ของ<?php echo $daySelect_thai ?>
                        <br>
                        <span class="badge badge-danger font-thai" data-toggle="popover2" title="กราฟแสดงจำนวนนักศึกษา" data-content="แสดงจำนวนนักศึกษาที่มาเรียนในตึก ณ วันปัจจุบันหรือวันที่เลือกดู ว่าเริ่มเรียน หรือเลิกเรียนในช่วงเวลาไหน จำนวนเท่าไหร่บ้าง">รายละเอียดเพิ่มเติม</span>
                      </h4>
                      <hr>
                      <!-- เวลาปัจจุบัน -->
                      <!-- <?php echo "<h1>" . $time_index_class .  ' ' .  $arr_numStart1 . ' ' . $arr_numEnd1 . "</h1>" ?> -->


                      <p style="font-size:20px; color:#EE5300;"><i class="fas fa-chart-bar"></i> Bar</p>
                      <!-- ============= chart ============= -->
                      <div class="chart-container">
                        <canvas id="myChart2_bar2" style="width:300px; height:350px;"></canvas>
                        <script>
                          var ctx = document.getElementById("myChart2_bar2").getContext('2d');
                          debugger;
                          // ======= data =========
                          var data = {
                            labels: [<?php echo $time_chart; ?>],
                            datasets: [{
                                label: "เริ่มเรียน",
                                data: [<?php echo $numStart; ?>],
                                backgroundColor: "rgb(29,233,182,0.55)"
                              },
                              {
                                label: "เลิกเรียน",
                                data: [<?php echo $numEnd; ?>],
                                backgroundColor: "rgb(213,0,0,0.55)"
                              }

                            ]
                          }
                          // ======= chart =========
                          var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: data,
                            options: {
                              "hover": {
                                "animationDuration": 0
                              },
                              "animation": {
                                "duration": 1,
                                "onComplete": function() {
                                  var chartInstance = this.chart,
                                    ctx = chartInstance.ctx;

                                  ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                                  ctx.textAlign = 'center';
                                  ctx.textBaseline = 'bottom';

                                  this.data.datasets.forEach(function(dataset, i) {
                                    var meta = chartInstance.controller.getDatasetMeta(i);
                                    meta.data.forEach(function(bar, index) {
                                      var data = dataset.data[index];
                                      ctx.fillStyle = '#444';
                                      ctx.fillText(data, bar._model.x, bar._model.y);

                                    });
                                  });
                                }
                              },
                              responsive: true,
                              maintainAspectRatio: false,
                              legend: {
                                "display": true
                              },
                              scales: {
                                yAxes: [{
                                  ticks: {
                                    beginAtZero: true,
                                    // max: Math.max(...data.datasets[0].data) + 10,
                                  },
                                  scaleLabel: {
                                    display: true,
                                    labelString: 'จำนวนนักศึกษา'
                                  }
                                }],
                                xAxes: [{
                                  scaleLabel: {
                                    display: true,
                                    labelString: 'ช่วงเวลาที่เริ่มและเลิกเรียน ใน<?php echo $building; ?>'
                                  }
                                }]
                              }
                            }
                          });
                        </script>
                      </div>
                      <!--============== End chart 2  ==============-->

                      <br>

                      <!--============== Image  ==============-->
                      <div class="row" style="margin-top: 20px; margin-bottom: 10px;">
                        <div class="col-6 pr-1">
                          <img src="images/dashboard/img_11.jpg" style="height:90%" class="mb-2 mw-100 w-100 rounded" alt="image">
                          <!-- <img src="images/dashboard/img_14.jpg" class="mw-100 w-100 rounded" alt="image"> -->
                        </div>
                        <div class="col-6 pl-1">
                          <img src="images/dashboard/img_133.jpg" style="height:90%" class="mb-2 mw-100 w-100 rounded" alt="image">
                          <!-- <img src="images/dashboard/img_12.jpg" style="height:46%" class="mw-100 w-100 rounded" alt="image"> -->
                        </div>
                      </div>

                      <!--============== End Image  ==============-->

                    </div>

                  </div>




                </div>
              </form>
            </div>
            <!-- ============= End Row2 Grid Char and calculate ============= -->

          </div>

        </div>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

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

    $(function() {
      $('#datetimepicker5').datetimepicker({
        format: 'LT',
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

    $(function() {
      $('#datetimepicker6').datetimepicker({
        format: 'LT',
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

    $(function() {
      $('[data-toggle="popover1"]').popover()
      $('[data-toggle="popover2"]').popover()

    })

    // กรณีที่เวลาที่ต้องการถึงเป้าหมายน้อยไป จะต้องเเจ้งเตือนบอก 
    //ไม่เเจ้งเตือน
    keep_alerttime = <?= $keep_alerttime; ?>;
    if (keep_alerttime == 0) {
      document.getElementById("alerttime").style.display = "none";
    }
  </script>
  <!-- end datepicker -->

  <!-- plugins:js -->
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