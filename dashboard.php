<?php
include 'config.inc.php';
include 'dataBase/dashboardDB.php';
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
                  <div class="card shadow p-2 mb-5 rounded" style="color:#fff; background-image: url('images/dashboard/Slanted-Gradient.svg'); height:100%; background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <h3><b>CMU Mass Transit Queueing Management Analysis Program</b></h3>
                    <h4 style="margin-top: 2%;" class="font-thai">โปรแกรมการวิเคราะห์เพื่อจัดคิวรถขนส่งมวลชนมหาวิทยาลัยเชียงใหม่</h4>
                    <hr style="border-top: 1px solid #fff; width: 90%;">
                    <p style="margin-top: 1%; margin-bottom: 0%;" class="font-thai">วิเคราะห์ข้อมูลรถขนส่งมวลชนเส้นทางสาย 1 และสาย 3</p>
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

                  <div class="row">

                    <!-- select route -->
                    <div class="col-sm-3">
                      <div class="row form-group font-thai" style="margin-top: 0px; margin-bottom: 0px;">
                        <label class="col-6 col-form-label" style="font-size: 18px"><b>เส้นทางสาย:</b></label>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="route_1" id="route_1" value="1" <?php echo ($route_1 == '1' ? 'checked' : ''); ?>>
                              1
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="route_3" id="route_3" value="3" <?php echo ($route_3 == '3' ? 'checked' : ''); ?>>
                              3
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end select route -->
                    <!-- select date -->
                    <div class="col-sm-7">
                      <div class="row form-group font-thai" style="margin-top: 0px; margin-bottom: 0px;">
                        <div style="text-align: right;" class="col-sm-2">
                          <label class="col-form-label font-thai">
                            <h4 style="font-family: 'Kanit', sans-serif !important;"><b>วันที่:</b></h4>
                          </label>
                          <!-- <label class="col-form-label" style="font-size: 18px;"><b>วันที่:</b></label> -->
                        </div>
                        <div class="col-sm-10">
                          <div class="input-group date" data-link-format="DD/MM/YYYY" data-date-format="DD/MM/YYYY" id="datetimepicker4" data-target-input="nearest">
                            <input type="text" name="daySelect" id="daySelect" style="font-size:16px; height:42px;" value="<?= $daySelect ?>" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
                            <div class="input-group-append" style="font-size:16px; height:42px;" data-target="#datetimepicker4" data-toggle="datetimepicker">
                              <div class="input-group-text  btn btn-gradient-primary"><i style="color:#ffffff;" class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end select date -->
                    <!-- button show -->
                    <div class="col">
                      <button name="show" value="show" type="submit" class="btn btn-gradient-primary btn-rounded btn-fw font-thai">ค้นหา</button>
                    </div>
                    <!-- end button show -->
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!--============= end select with show dashboard =============  -->
          <!--============= dashboard =============  -->
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
              </span>
              Dashboard
            </h3>
          </div>
          <!--============= End dashboard =============  -->

          <!-- <?php echo $daySelect; ?>
          <?php echo $daySelect_DB; ?> -->

          <!--============= show dashboard =============  -->
          <div class="row">
            <!-- =============Row1 Grid Chart line ============= -->
            <div class="container-fluid font-thai" style="margin-top: 1%; width:100%; display: block; margin-left: auto; margin-right: auto;">


              <div class="row">
                <div class="col-sm-12">
                  <div class="p-3 mb-5 bg-white rounded" style="height:100%;">
                    <div class="row">

                      <div class="col-sm-4" style="margin-top: 1%;">
                        <!-- <?php echo $dayStartF; ?> -->
                        <button style="height: 35px;" class="btn btn-sm btn-outline-primary dropdown-toggle font-thai btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $distanceTime; ?></button>
                        <div class="dropdown-menu font-thai">
                          <input type="hidden" id="distanceTime" name="distanceTime" value="<?= $distanceTime ?>">
                          <!-- &daySelect=<?= $daySelect ?>&route_1=<?= $route_1 ?>&route_3=<?= $route_3 ?> -->
                          <a class="dropdown-item" href="dashboard.php?distanceTime=ช่วงเช้า (07:00 - 10:00 น.)">ช่วงเช้า (07:00 - 10:00 น.) </a>
                          <a class="dropdown-item" href="dashboard.php?distanceTime=ช่วงเทียง (11:00 - 13:00 น.)">ช่วงเทียง (11:00 - 13:00 น.)</a>
                          <a class="dropdown-item" href="dashboard.php?distanceTime=ช่วงบ่าย (14:00 - 16:00 น.)">ช่วงบ่าย (14:00 - 16:00 น.)</a>
                          <a class="dropdown-item" href="dashboard.php?distanceTime=ช่วงเย็น (17:00 - 19:00 น.)">ช่วงเย็น (17:00 - 19:00 น.)</a>
                          <a class="dropdown-item" href="dashboard.php?distanceTime=ช่วงดึก (20:00 - 22:00 น.)">ช่วงดึก (20:00 - 22:00 น.)</a>
                        </div>
                      </div>

                      <!-- <div class="col-sm-6" style="margin-top: 1%;">
                        <label class="col-form-label font-thai"><h4 style="font-family: 'Kanit', sans-serif !important;"><b>ระยะห่างของช่วงเวลาทุกๆ :</b></h4></label>
                      </div> -->

                      <div class="col-sm-5" style="margin-top: 1%;">
                        <!-- <?php echo $dayStartF; ?> -->
                        <div class="row">
                          <div class="col">
                            <label class="col-form-label font-thai">
                              <h4 style="font-family: 'Kanit', sans-serif !important;"><b>ระยะห่างของช่วงเวลาทุกๆ :</b></h4>
                            </label>
                          </div>
                          <div class="col">
                            <button style="height: 35px;" class="btn btn-sm btn-outline-primary dropdown-toggle font-thai btn-block" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $timeSpacing; ?></button>
                            <div class="dropdown-menu font-thai">
                              <input type="hidden" id="timeSpacing" name="timeSpacing" value="<?= $timeSpacing ?>">
                              <!-- &daySelect=<?= $daySelect ?>&route_1=<?= $route_1 ?>&route_3=<?= $route_3 ?> -->
                              <a class="dropdown-item" href="dashboard.php?timeSpacing=2 นาที">2 นาที</a>
                              <a class="dropdown-item" href="dashboard.php?timeSpacing=4 นาที">4 นาที</a>
                              <a class="dropdown-item" href="dashboard.php?timeSpacing=6 นาที">6 นาที</a>
                              <a class="dropdown-item" href="dashboard.php?timeSpacing=8 นาที">8 นาที</a>
                              <a class="dropdown-item" href="dashboard.php?timeSpacing=10 นาที">10 นาที</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <br>

                    <center>
                      <!-- <i class="fas fa-bus" style="margin-top: 3%; margin-bottom: 1%; font-size:60px; color:#6E008A; "></i> -->
                      <div class="card-body font-thai">

                        <h4 align='left' class="card-title font-thai" style="font-family: 'Kanit', sans-serif !important;">ปริมาณการใช้เส้นทาง ในแต่ละช่วงเวลาของวันที่ <?php echo $daySelect ?>
                          <br>
                          <span class="badge badge-primary  font-thai" data-toggle="popover1" title="กราฟแสดงปริมาณการใช้เส้นทาง" data-content="แสดงปริมาณการใช้เส้นทาง ว่ามีรถเคลื่อนที่ทั้งหมดกี่คัน เเละจำนวนนักศึกษาที่ขึ้นรถรวมเท่าไหร่ ในแต่ละช่วงเวลาของวันที่ทำการค้นหา">รายละเอียดเพิ่มเติม</span>
                        </h4>
                        <hr>

                        <div class="row">
                          <div class="col-sm-2">
                            <p align='left' style="font-size:20px; color:#6E008A;"><i class="fas fa-chart-bar"></i> <i class="fas fa-chart-line"></i> Bar & Line</p>
                          </div>
                          <div class="col">
                            <p align='left'><img src="images/BusR1.svg" style="height:10%; width:10%"> &nbsp;จำนวนรถสาย 1</p>
                          </div>
                          <div class="col">
                            <p align='left'><img src="images/BusR3.svg" style="height:10%; width:10%"> &nbsp;จำนวนรถสาย 3</p>
                          </div>
                          <div class="col-sm-2">
                            <div class="row">
                              <div class="col-sm-1">
                                <div style="background-color:#00FF00; height:20px; width:20px"></div>
                              </div>
                              <div class="col-sm-7">สาย 1</div>
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="row">
                              <div class="col-sm-1">
                                <div style="background-color:#FF0033; height:20px; width:20px"></div>
                              </div>
                              <div class="col-sm-7">สาย 3</div>
                            </div>
                          </div>

                        </div>
                        <!-- ============= chart Area ============= -->

                        <?php

                        // echo $time_chart_str . "<br>";
                        // echo $count_bus_str. "<br>";
                        // echo $max_peopleInbus_str . "<br>";

                        // echo $length_result2;
                        // $len = count($time_chart);
                        // for ($i = 0; $i < $len; $i++) {

                        //   echo  $time_chart[$i]. ' ' . $count_bus[$i] . ' ' . $max_peopleInbus[$i];
                        //   echo "<br>";
                        // }
                        ?>
                        <br>
                        <div class="chart-container">
                          <div class="NewchartWrapper">
                            <div class="NewchartAreaWrapper">
                              <div class="NewchartAreaWrapper2">
                                <canvas id="myChart_bar1" style="width:<?php echo $width_chart ?>; height:350px; overflow-x: scroll;"></canvas>
                              </div>
                            </div>
                          </div>
                          <script>
                            var ctx = document.getElementById("myChart_bar1").getContext('2d');
                            debugger;
                            // ======= color =======
                            var red_gradient = ctx.createLinearGradient(0, 0, 0, 600);
                            red_gradient.addColorStop(0, '#FF0033');
                            red_gradient.addColorStop(1, '#880E4F');

                            var green_gradient = ctx.createLinearGradient(0, 0, 0, 600);
                            green_gradient.addColorStop(0, '#00FF00');
                            green_gradient.addColorStop(1, '#336600');

                            //=======image=======
                            var img1 = new Image();
                            img1.src = "images/BusR1.svg";

                            var img3 = new Image();
                            img3.src = "images/BusR3.svg";

                            //======= เก็บเส้นทางจะได้ if กราฟถูก =======
                            var route_1 = <?php echo $route_1; ?>;
                            var route_3 = <?php echo $route_3; ?>;


                            // ======= data =========

                            // สาย 1 อย่างเดียว
                            if (route_1 == '1' && route_3 != '3') {
                              var data = {
                                labels: [<?php echo $time_chart_str; ?>],
                                datasets: [{
                                    label: "จำนวนรถสาย 1",
                                    backgroundColor: 'rgb(20, 90, 50 , 1)',
                                    borderColor: 'rgb(212, 239, 223, 0.90)',
                                    // borderDash: [5, 5],
                                    data: [<?php echo $count_bus_str1; ?>],
                                    type: 'line',
                                    fill: false,

                                  },

                                  {
                                    label: "สาย 1",
                                    data: [<?php echo $max_peopleInbus_str1; ?>],
                                    backgroundColor: green_gradient,
                                    hoverBackgroundColor: green_gradient,
                                    hoverBorderWidth: 2,
                                    hoverBorderColor: '#336600'
                                  },

                                ]
                              }
                            }
                            // สาย 3 อย่างเดียว
                            else if (route_1 != '1' && route_3 == '3') {
                              var data = {
                                labels: [<?php echo $time_chart_str; ?>],
                                datasets: [{
                                    // fillColor: "rgba(151,187,205,0.2)",
                                    label: "จำนวนรถสาย 3",
                                    backgroundColor: 'rgb(120, 40, 31 , 1)',
                                    borderColor: 'rgb(250, 219, 216, 0.90)',
                                    // borderDash: [5, 5],
                                    data: [<?php echo $count_bus_str3; ?>],
                                    type: 'line',
                                    fill: false,
                                  },
                                  {
                                    label: "สาย 3",
                                    data: [<?php echo $max_peopleInbus_str3; ?>],
                                    backgroundColor: red_gradient,
                                    hoverBackgroundColor: red_gradient,
                                    hoverBorderWidth: 2,
                                    hoverBorderColor: '#880E4F',
                                  }

                                ]
                              }
                            }

                            // ทั้ง 2 สาย
                            else {
                              var data = {
                                labels: [<?php echo $time_chart_str; ?>],
                                datasets: [{
                                    label: "จำนวนรถสาย 1",
                                    backgroundColor: 'rgb(20, 90, 50 , 1)',
                                    borderColor: 'rgb(212, 239, 223, 0.90)',
                                    // borderDash: [5, 5],
                                    data: [<?php echo $count_bus_str1; ?>],
                                    type: 'line',
                                    fill: false,

                                  },
                                  {
                                    // fillColor: "rgba(151,187,205,0.2)",
                                    label: "จำนวนรถสาย 3",
                                    backgroundColor: 'rgb(120, 40, 31 , 1)',
                                    borderColor: 'rgb(250, 219, 216, 0.90)',
                                    // borderDash: [5, 5],
                                    data: [<?php echo $count_bus_str3; ?>],
                                    type: 'line',
                                    fill: false,
                                  },
                                  {
                                    label: "สาย 1",
                                    data: [<?php echo $max_peopleInbus_str1; ?>],
                                    backgroundColor: green_gradient,
                                    hoverBackgroundColor: green_gradient,
                                    hoverBorderWidth: 2,
                                    hoverBorderColor: '#336600'
                                  },
                                  {
                                    label: "สาย 3",
                                    data: [<?php echo $max_peopleInbus_str3; ?>],
                                    backgroundColor: red_gradient,
                                    hoverBackgroundColor: red_gradient,
                                    hoverBorderWidth: 2,
                                    hoverBorderColor: '#880E4F',
                                  }

                                ]
                              }
                            }

                            //========= width bar =========
                            if (!(route_1 == '1' && route_3 == '3')) {
                              var x = {
                                yAxes: [{
                                  ticks: {
                                    beginAtZero: true,
                                    fontSize: 14,
                                    // max: Math.max(...data.datasets[0].data) + 5,
                                  },
                                  scaleLabel: {
                                    display: true,
                                    fontSize: 14,
                                    labelString: 'จำนวนนักศึกษาบนรถ (คน)'
                                  }
                                }],

                                xAxes: [{
                                  scaleLabel: {
                                    display: true,
                                    fontSize: 14,
                                    labelString: 'ช่วงเวลา (่ชั่วโมง:นาที)',
                                  },
                                  categoryPercentage: 1.0,
                                  barPercentage: 0.5
                                }]
                              }
                            } else {
                              var x = {
                                yAxes: [{
                                  ticks: {
                                    beginAtZero: true,
                                    fontSize: 14,
                                    // max: Math.max(...data.datasets[0].data) + 5,
                                  },
                                  scaleLabel: {
                                    display: true,
                                    fontSize: 14,
                                    labelString: 'จำนวนนักศึกษาบนรถ (คน)'
                                  }
                                }],

                                xAxes: [{
                                  scaleLabel: {
                                    display: true,
                                    fontSize: 14,
                                    labelString: 'ช่วงเวลา (ชั่วโมง:นาที)',
                                  }
                                }]
                              }
                            }
                            // ======= chart =========

                            var myChart = new Chart(ctx, {
                              type: 'bar',
                              data: data,
                              options: {
                                "hover": {
                                  "animationDuration": 0
                                },
                                animation: {
                                  "duration": 1,
                                  "onComplete": function() {
                                    var chartInstance = this.chart,
                                      ctx1 = chartInstance.ctx;
                                    ctx1.font = 'bold 14px Arial';

                                    // ctx1.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                                    ctx1.textAlign = 'center';
                                    ctx1.textBaseline = 'bottom';

                                    // เก็บค่า
                                    var count_bus_str1 = [<?php echo $count_bus_str1; ?>];
                                    var count_bus_str3 = [<?php echo $count_bus_str3; ?>];

                                    var max_peopleInbus_str1 = [<?php echo $max_peopleInbus_str1; ?>];
                                    var max_peopleInbus_str3 = [<?php echo $max_peopleInbus_str3; ?>];
                                    // end เก็บค่า



                                    this.data.datasets.forEach(function(dataset, i) {
                                      var meta = chartInstance.controller.getDatasetMeta(i);
                                      // var alreadyHidden = (ci.getDatasetMeta(index).hidden === null) ? false : ci.getDatasetMeta(index).hidden;
                                      meta.data.forEach(function(bar, index) {
                                        // var data = dataset.data[index];

                                        var r = dataset.label;
                                        // var alreadyHidden = dataset.hi
                                        // if(r == 'สาย 1'){
                                        //   // var data = dataset.data[index];
                                        //   var data = max_peopleInbus_str1[index];
                                        //   ctx1.fillStyle = '#444';
                                        //   ctx1.fillText(data, bar._model.x, bar._model.y);
                                        // }
                                        // else if(r == 'สาย 3'){
                                        //   // var data = dataset.data[index];
                                        //   var data = max_peopleInbus_str3[index];
                                        //   ctx1.fillStyle = '#444';
                                        //   ctx1.fillText(data, bar._model.x, bar._model.y );
                                        // }


                                        // จำนวนรถที่วิ่ง ณ เวลานั้น
                                        if (!(route_1 == '1' && route_3 == '3')) {
                                          if (r == 'จำนวนรถสาย 1') {
                                            var data = count_bus_str1[index];
                                            ctx1.fillStyle = '#000';
                                            ctx1.drawImage(img1, bar._model.x - 12, bar._model.y - 30, 25, 25);
                                            ctx1.fillText(data, bar._model.x, bar._model.y - 13);

                                          } else if (r == 'จำนวนรถสาย 3') {
                                            var data = count_bus_str3[index];
                                            ctx1.fillStyle = '#000';
                                            ctx1.drawImage(img3, bar._model.x - 12, bar._model.y - 30, 25, 25);
                                            ctx1.fillText(data, bar._model.x, bar._model.y - 13);
                                          }
                                        }

                                      });
                                    });
                                  }
                                },
                                responsive: false,
                                maintainAspectRatio: false,
                                scales: x,
                                tooltips: {
                                  titleFontSize: 0,
                                  titleMarginBottom: 0,
                                  bodyFontSize: 12
                                },
                                legend: {
                                  display: false
                                }

                              }
                            });
                          </script>
                        </div>
                        <!-- ============= end chart Area ============= -->
                        
                        <br>
                        <br>
                        <!-- ============= chart 3 หาอัตราส่วนที่นั่งบนรถ ต่อจำนวนนักศึกษาที่ขึ้นรถ  ============= -->
                        <div class="card-body font-thai">

                          <h4 align='left' class="card-title font-thai" style="font-family: 'Kanit', sans-serif !important;">จำนวนที่นั่งที่ว่างบนรถขนส่งมวลชนในวันที่ <?php echo $daySelect ?>
                            <br>
                            <span class="badge badge-primary  font-thai" data-toggle="popover2" title="กราฟแสดงจำนวนที่นั่งที่ว่างบนรถขนส่งมวลชน" data-content="แสดงจำนวนที่นั่งที่ว่างบนรถขนส่งมวลชน ในเเต่ละช่วงเวลา รวมกันทุกคัน">รายละเอียดเพิ่มเติม</span>
                          </h4>
                          <hr>

                          <div class="row">
                            <div class="col-sm-2">
                              <p align='left' style="font-size:20px; color:#6E008A;"><i class="fas fa-chart-line"></i>Line</p>
                            </div>
                            <div class="col">
                              <p align='left'><img src="images/BusR1.svg" style="height:10%; width:10%"> &nbsp;จำนวนรถสาย 1</p>
                            </div>
                            <div class="col">
                              <p align='left'><img src="images/BusR3.svg" style="height:10%; width:10%"> &nbsp;จำนวนรถสาย 3</p>
                            </div>
                            <div class="col-sm-2">
                              <div class="row">
                                <div class="col-sm-1">
                                  <div style="background-color:rgb(88, 214, 141,0.25); height:20px; width:20px"></div>
                                </div>
                                <div class="col-sm-7">สาย 1</div>
                              </div>
                            </div>
                            <div class="col-sm-2">
                              <div class="row">
                                <div class="col-sm-1">
                                  <div style="background-color:rgb(231, 76, 60,0.25); height:20px; width:20px"></div>
                                </div>
                                <div class="col-sm-7">สาย 3</div>
                              </div>
                            </div>
                          </div>
                          <!-- ============= chart Area ============= -->
                          <br>
                          <div class="chart-container">
                            <div class="NewchartWrapper">
                              <div class="NewchartAreaWrapper">
                                <div class="NewchartAreaWrapper2">
                                  <canvas id="myChart_bar2" style="width:<?php echo $width_chart ?>; height:350px; overflow-x: scroll;"></canvas>
                                </div>
                              </div>
                            </div>

                            <script>
                              var ctx = document.getElementById('myChart_bar2').getContext('2d');
                              debugger;

                              // สาย 1 อย่างเดียว
                              if (route_1 == '1' && route_3 != '3') {

                                var data = {
                                  labels: [<?php echo $time_chart_str; ?>],
                                  datasets: [{
                                      label: 'สาย 1',
                                      backgroundColor: 'rgb(88, 214, 141,0.25)',
                                      borderColor: 'rgb(88, 214, 141,0.80)',
                                      data: [<?php echo $num_seat_str1; ?>],
                                    },
                                    {
                                      label: "จำนวนรถสาย 1",
                                      backgroundColor: 'rgb(20, 90, 50 , 1)',
                                      borderColor: 'rgb(212, 239, 223, 0.90)',
                                      // borderDash: [5, 5],
                                      data: [<?php echo $count_bus_str1; ?>],
                                      type: 'line',
                                      fill: false,

                                    },
                                  ]
                                }
                              }
                              // สาย 3 อย่างเดียว
                              else if (route_1 != '1' && route_3 == '3') {
                                var data = {
                                  labels: [<?php echo $time_chart_str; ?>],
                                  datasets: [{
                                      label: 'สาย 3',
                                      backgroundColor: 'rgb(231, 76, 60,0.25)',
                                      borderColor: 'rgb(231, 76, 60,0.55)',
                                      data: [<?php echo $num_seat_str3; ?>],
                                    },
                                    {
                                      // fillColor: "rgba(151,187,205,0.2)",
                                      label: "จำนวนรถสาย 3",
                                      backgroundColor: 'rgb(120, 40, 31 , 1)',
                                      borderColor: 'rgb(250, 219, 216, 0.90)',
                                      // borderDash: [5, 5],
                                      data: [<?php echo $count_bus_str3; ?>],
                                      type: 'line',
                                      fill: false,
                                    },
                                  ]
                                }
                              } else {
                                var data = {
                                  labels: [<?php echo $time_chart_str; ?>],
                                  datasets: [{
                                      label: 'สาย 1',
                                      backgroundColor: 'rgb(88, 214, 141,0.25)',
                                      borderColor: 'rgb(88, 214, 141,0.80)',
                                      data: [<?php echo $num_seat_str1; ?>],
                                    },
                                    {
                                      label: 'สาย 3',
                                      backgroundColor: 'rgb(231, 76, 60,0.25)',
                                      borderColor: 'rgb(231, 76, 60,0.55)',
                                      data: [<?php echo $num_seat_str3; ?>],
                                    },
                                    {
                                      label: "จำนวนรถสาย 1",
                                      backgroundColor: 'rgb(20, 90, 50 , 1)',
                                      borderColor: 'rgb(212, 239, 223, 0.90)',
                                      // borderDash: [5, 5],
                                      data: [<?php echo $count_bus_str1; ?>],
                                      type: 'line',
                                      fill: false,

                                    },
                                    {
                                      // fillColor: "rgba(151,187,205,0.2)",
                                      label: "จำนวนรถสาย 3",
                                      backgroundColor: 'rgb(120, 40, 31 , 1)',
                                      borderColor: 'rgb(250, 219, 216, 0.90)',
                                      // borderDash: [5, 5],
                                      data: [<?php echo $count_bus_str3; ?>],
                                      type: 'line',
                                      fill: false,
                                    },
                                  ]
                                }
                              }

                              var chart = new Chart(ctx, {
                                type: 'line',
                                data: data,
                                options: {
                                  "hover": {
                                    "animationDuration": 0
                                  },
                                  animation: {
                                    "duration": 1,
                                    "onComplete": function() {
                                      var chartInstance = this.chart,
                                        ctx1 = chartInstance.ctx;
                                      ctx1.font = 'bold 14px Arial';

                                      // ctx1.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                                      ctx1.textAlign = 'center';
                                      ctx1.textBaseline = 'bottom';

                                      // เก็บค่า
                                      var count_bus_str1 = [<?php echo $count_bus_str1; ?>];
                                      var count_bus_str3 = [<?php echo $count_bus_str3; ?>];

                                      var max_peopleInbus_str1 = [<?php echo $max_peopleInbus_str1; ?>];
                                      var max_peopleInbus_str3 = [<?php echo $max_peopleInbus_str3; ?>];
                                      // end เก็บค่า



                                      this.data.datasets.forEach(function(dataset, i) {
                                        var meta = chartInstance.controller.getDatasetMeta(i);
                                        // var alreadyHidden = (ci.getDatasetMeta(index).hidden === null) ? false : ci.getDatasetMeta(index).hidden;
                                        meta.data.forEach(function(bar, index) {
                                          // var data = dataset.data[index];

                                          var r = dataset.label;

                                          // จำนวนรถที่วิ่ง ณ เวลานั้น
                                          if (!(route_1 == '1' && route_3 == '3')) {
                                            if (r == 'จำนวนรถสาย 1') {
                                              var data = count_bus_str1[index];
                                              ctx1.fillStyle = '#000';
                                              ctx1.drawImage(img1, bar._model.x - 12, bar._model.y - 30, 25, 25);
                                              ctx1.fillText(data, bar._model.x, bar._model.y - 13);

                                            } else if (r == 'จำนวนรถสาย 3') {
                                              var data = count_bus_str3[index];
                                              ctx1.fillStyle = '#000';
                                              ctx1.drawImage(img3, bar._model.x - 12, bar._model.y - 30, 25, 25);
                                              ctx1.fillText(data, bar._model.x, bar._model.y - 13);
                                            }
                                          }

                                        });
                                      });
                                    }
                                  },
                                  responsive: false,
                                  maintainAspectRatio: false,
                                  legend: {
                                    "display": false
                                  },
                                  elements: {
                                    line: {
                                      fill: true
                                    }
                                  },
                                  scales: {
                                    yAxes: [{
                                      ticks: {
                                        beginAtZero: true,
                                        fontSize: 14,
                                        // max: Math.max(...data.datasets[0].data) + 5,
                                      },
                                      scaleLabel: {
                                        display: true,
                                        fontSize: 14,
                                        labelString: 'จำนวนที่นั่งที่ว่างบนรถขนส่งมวลชน (ที่นั่ง)'
                                      }
                                    }],
                                    xAxes: [{
                                      scaleLabel: {
                                        display: true,
                                        fontSize: 14,
                                        labelString: 'ช่วงเวลา (่ชั่วโมง:นาที)'
                                      }
                                    }]

                                  }
                                }
                              });
                            </script>
                          </div>
                          <!-- ============= end chart Area ============= -->
                          <!-- ============= End chart 2 หาจำนวนที่นั่งว่าง Area ============= -->
                          <br>
                          <br>
                          <!-- ============= chart 2 หาจำนวนที่นั่งว่าง Area ============= -->
                          <div class="card-body font-thai">

                            <h4 align='left' class="card-title font-thai" style="font-family: 'Kanit', sans-serif !important;">อัตราส่วนที่นั่งบนรถ ต่อจำนวนนักศึกษาที่ขึ้นรถวันที่  <?php echo $daySelect ?>
                              <br>
                              <span class="badge badge-primary  font-thai" data-toggle="popover2" title="กราฟแสดงอัตราส่วนที่นั่งบนรถ ต่อจำนวนนักศึกษาที่ขึ้นรถ" data-content="แสดงอัตราส่วนที่นั่งบนรถ ต่อจำนวนนักศึกษาที่ขึ้นรถ ในเเต่ละช่วงเวลา หากมีจำนวนน้อย จะแสดงให้เห็นว่าจำนวนรถที่ปล่อยออกไป เหมาะสมกับจำนวนนักศึกษา">รายละเอียดเพิ่มเติม</span>
                            </h4>
                            <hr>

                            <div class="row">
                              <div class="col-sm-2">
                                <p align='left' style="font-size:20px; color:#6E008A;"><i class="fas fa-chart-line"></i>Line</p>
                              </div>
                              <div class="col-sm-2">
                                <div class="row">
                                  <div class="col-sm-1">
                                    <div style="background-color:rgb(88, 214, 141,0.25); height:20px; width:20px"></div>
                                  </div>
                                  <div class="col-sm-7">สาย 1</div>
                                </div>
                              </div>
                              <div class="col-sm-2">
                                <div class="row">
                                  <div class="col-sm-1">
                                    <div style="background-color:rgb(231, 76, 60,0.25); height:20px; width:20px"></div>
                                  </div>
                                  <div class="col-sm-7">สาย 3</div>
                                </div>
                              </div>
                            </div>
                            <!-- ============= chart Area ============= -->
                            <br>
                            <div class="chart-container">
                              <div class="NewchartWrapper">
                                <div class="NewchartAreaWrapper">
                                  <div class="NewchartAreaWrapper2">
                                    <canvas id="myChart_bar3" style="width:<?php echo $width_chart ?>; height:350px; overflow-x: scroll;"></canvas>
                                  </div>
                                </div>
                              </div>

                              <script>
                                var ctx = document.getElementById('myChart_bar3').getContext('2d');
                                debugger;

                                // สาย 1 อย่างเดียว
                                if (route_1 == '1' && route_3 != '3') {

                                  var data = {
                                    labels: [<?php echo $time_chart_str; ?>],
                                    datasets: [{
                                        label: 'สาย 1',
                                        backgroundColor: 'rgb(88, 214, 141,0.25)',
                                        borderColor: 'rgb(88, 214, 141,0.80)',
                                        data: [<?php echo $Ratio_numSeat_numP1; ?>],
                                      },
                                    ]
                                  }
                                }
                                // สาย 3 อย่างเดียว
                                else if (route_1 != '1' && route_3 == '3') {
                                  var data = {
                                    labels: [<?php echo $time_chart_str; ?>],
                                    datasets: [{
                                        label: 'สาย 3',
                                        backgroundColor: 'rgb(231, 76, 60,0.25)',
                                        borderColor: 'rgb(231, 76, 60,0.55)',
                                        data: [<?php echo $Ratio_numSeat_numP3; ?>],
                                      },
                
                                    ]
                                  }
                                } else {
                                  var data = {
                                    labels: [<?php echo $time_chart_str; ?>],
                                    datasets: [{
                                        label: 'สาย 1',
                                        backgroundColor: 'rgb(88, 214, 141,0.25)',
                                        borderColor: 'rgb(88, 214, 141,0.80)',
                                        data: [<?php echo $Ratio_numSeat_numP1; ?>],
                                      },
                                      {
                                        label: 'สาย 3',
                                        backgroundColor: 'rgb(231, 76, 60,0.25)',
                                        borderColor: 'rgb(231, 76, 60,0.55)',
                                        data: [<?php echo $Ratio_numSeat_numP3; ?>],
                                      },
                                    ]
                                  }
                                }

                                var chart = new Chart(ctx, {
                                  type: 'line',
                                  data: data,
                                  options: {
                                    "hover": {
                                      "animationDuration": 0
                                    },
                                    animation: {
                                      "duration": 1,
                                      "onComplete": function() {
                                        var chartInstance = this.chart,
                                          ctx1 = chartInstance.ctx;
                                          ctx1.font = 'bold 12px Arial';
                                          ctx.textAlign = 'center';
                                          ctx.textBaseline = 'bottom';

                                          this.data.datasets.forEach(function(dataset, i) {
                                            var meta = chartInstance.controller.getDatasetMeta(i);
                                            meta.data.forEach(function(bar, index) {

                                              var data = dataset.data[index];
                
                                              if (!(route_1 == '1' && route_3 == '3')) {
                                                ctx.fillStyle = '#444';
                                                ctx.fillText(data, bar._model.x, bar._model.y);
                                              }

                                            });
                                          });
                              
                                      }
                                    },
                                    responsive: false,
                                    maintainAspectRatio: false,
                                    legend: {
                                      "display": false
                                    },
                                    elements: {
                                      line: {
                                        fill: true
                                      }
                                    },
                                    scales: {
                                      yAxes: [{
                                        ticks: {
                                          beginAtZero: true,
                                          fontSize: 14,
                                          // max: Math.max(...data.datasets[0].data) + 5,
                                        },
                                        scaleLabel: {
                                          display: true,
                                          fontSize: 14,
                                          labelString: 'อัตราส่วนที่นั่งบนรถ ต่อจำนวนนักศึกษาที่ขึ้นรถ'
                                        }
                                      }],
                                      xAxes: [{
                                        scaleLabel: {
                                          display: true,
                                          fontSize: 14,
                                          labelString: 'ช่วงเวลา (่ชั่วโมง:นาที)'
                                        }
                                      }]

                                    }
                                  }
                                });
                              </script>
                            </div>
                            <!-- ============= end chart Area ============= -->
                          <!-- ============= End chart 3 หาอัตราส่วนที่นั่งบนรถ ต่อจำนวนนักศึกษาที่ขึ้นรถ  ============= -->



                    </center>
                  </div>
                </div>
              </div>
            </div>
            <!-- =============End Row1 Grid Chart line ============= -->

            <!-- =============Row2 data table ============= -->
            <div class="container-fluid font-thai" style="margin-top: 3%; width:100%; display: block; margin-left: auto; margin-right: auto;">
              <div class="row">
                <div class="col-sm-12">
                  <div class="p-3 mb-5 bg-white rounded" style="height:100%;">
                    <center>
                      <!-- <i class="fas fa-bus" style="margin-top: 3%; margin-bottom: 1%; font-size:60px; color:#6E008A; "></i> -->
                      <div class="card-body font-thai">
                        <h4 align='left' class="card-title font-thai" style="font-family: 'Kanit', sans-serif !important;">ข้อมูลรถขนส่งมวลชน ตลอดทั้งวันที่ <?php echo $daySelect ?></h4>
                        <hr>
                        <p align='left' style="font-size:20px; color:#6E008A;"><i class="fas fa-th-list"></i> Table</p>

                      </div>

                      <!-- <?php
                            echo $route_1;
                            echo "<br>";
                            echo $route_3;
                            echo "<br>";
                            echo $daySelect_DB;
                            ?> -->

                      <div class="container">
                        <div class="table-responsive">
                          <table id="table_id" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <td><i class="fas fa-clock" style="color:#6E008A;"></i> เวลา (time) </td>
                                <td><i class="fas fa-bus" style="color:#6E008A;"></i> หมายเลขรถ (bus)</td>
                                <td><i class="fas fa-route" style="color:#6E008A;"></i> หมายเลขเส้นทาง (route)</td>
                                <td><i class="fas fa-user-graduate" style="color:#6E008A;"></i> จำนวนผู้โดยสาร (passenger)</td>
                                <td><i class="fas fa-tachometer-alt" style="color:#6E008A;"></i> ความเร็วรถ หน่วย เมตร/วินาที (speed)</td>
                              </tr>
                            </thead>

                            <?php
                            foreach ($result as $row) {
                              $keep = explode("T", $row["timestamp"]);
                              $keep = explode(".", $keep[1]);
                              echo '  
                                          <tr>  
                                            <td>' . $keep[0] . '</td>
                                            <td>' . $row["bus"] . '</td>
                                            <td>' . $row["route"] . '</td>
                                            <td>' . $row["passenger"] . '</td>
                                            <td>' . $row["speed"] . '</td>
                                          </tr>  
                                          ';
                            }
                            ?>
                          </table>
                        </div>
                      </div>
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