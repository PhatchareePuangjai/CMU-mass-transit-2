<?php
include 'config.inc.php';
include 'dataBase/M2_chartBarTimeDB.php';
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

<body class="font-thai">
    <!-- =============body============== -->
    <div class="container-fluid" class="font-thai" style="margin-top: 3%; margin-bottom: 3%; width:95%; height:100%; display: block; margin-left: auto; margin-right: auto;">
        <div class="shadow p-3 mb-5 bg-white rounded" style="height:97%;">
            <h5 class="font-thai">เวลาเฉลี่ยในการเดินทางไปยัง<?php echo $building; ?> ในแต่ละช่วงเวลาของแต่ละวัน เส้นทางสาย 1
                <br>
                <span class="badge badge-warning  font-thai" data-toggle="popover1" title="กราฟแสดงเวลาเฉลี่ยในการเดินทาง" data-content="แสดงเวลาเฉลี่ยในการเดินทางไปยังปลายทางของเส้นทางสาย 1 ว่าในเเต่ละช่วงเวลาของแต่ละวัน ใช้เวลาเฉลี่ยเท่าไหร่">รายละเอียดเพิ่มเติม</span>
            </h5>
            <hr>
            <p style="font-size:20px; color:#FFC100;"><i class="fas fa-chart-bar"></i> Bar</p>
            <br>
            <br>
            <!-- ==============chart============= -->
            <div class="chart-container">
                <canvas id="myChart2" style="width:700px; height:700px;"></canvas>
                <script>
                    var ctx = document.getElementById("myChart2").getContext('2d');
                    debugger;
                    // ======= data =========
                    var data = {
                        labels: [<?php echo $timeBus_avg; ?>],
                        datasets: [

                            {
                                label: "วันจันทร์",
                                backgroundColor: 'rgb(251, 232, 102 , 0.55)',
                                borderColor: 'rgb(212, 172, 13, 0.55)',
                                data: [<?= $StimeBus_avg_Mo1; ?>],
                            },
                            {
                                label: "วันอังคาร",
                                backgroundColor: 'rgb(255, 99, 132, 0.55)',
                                borderColor: 'rgb(212, 22, 180, 0.55)',
                                data: [<?= $StimeBus_avg_Tu1; ?>],
                            },
                            {
                                label: "วันพุธ",
                                backgroundColor: 'rgb(72, 201, 176, 0.55)',
                                borderColor: 'rgb(14, 98, 81, 0.55)',
                                data: [<?= $StimeBus_avg_We1; ?>],
                            },
                            {
                                label: "วันพฤหัสบดี",
                                backgroundColor: 'rgb(235, 152, 78, 0.55)',
                                borderColor: 'rgb(175, 96, 26, 0.55)',
                                data: [<?= $StimeBus_avg_Th1; ?>],
                            },
                            {
                                label: "วันศุกร์",
                                backgroundColor: 'rgb(133, 193, 233, 0.55)',
                                borderColor: 'rgb(40, 116, 166, 0.55)',
                                data: [<?= $StimeBus_avg_Fr1; ?>],
                            },
                            {
                                label: "วันเสาร์",
                                backgroundColor: 'rgb(210, 180, 222, 0.55)',
                                borderColor: 'rgb(108, 52, 131, 0.55)',
                                data: [<?= $StimeBus_avg_Sa1; ?>],
                            },
                            {
                                label: "วันอาทิตย์sd",
                                backgroundColor: 'rgb(255, 79, 79, 0.55)',
                                borderColor: 'rgb(123, 36, 28, 0.55)',
                                data: [<?= $StimeBus_avg_Su1; ?>],
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
                                        labelString: 'เวลาเฉลี่ยในการเดินทางไปยังตึก (นาที)'
                                    }
                                }],
                                xAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'ช่วงเวลา (นาฬิกา)'
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="container-fluid" class="font-thai" style="margin-top: 3%; margin-bottom: 3%; width:95%; height:100%; display: block; margin-left: auto; margin-right: auto;">
        <div class="shadow p-3 mb-5 bg-white rounded" style="height:97%;">
            <h5 class="font-thai">เวลาเฉลี่ยในการเดินทางไปยัง<?php echo $building; ?> ในแต่ละช่วงเวลาของแต่ละวัน เส้นทางสาย 3
                <br>
                <span class="badge badge-warning  font-thai" data-toggle="popover2" title="กราฟแสดงเวลาเฉลี่ยในการเดินทาง" data-content="แสดงเวลาเฉลี่ยในการเดินทางไปยังปลายทางของเส้นทางสาย 3 ว่าในเเต่ละช่วงเวลาของแต่ละวัน ใช้เวลาเฉลี่ยเท่าไหร่">รายละเอียดเพิ่มเติม</span>
            </h5>
            <hr>
            <p style="font-size:20px; color:#FFC100;"><i class="fas fa-chart-bar"></i> Bar</p>
            <br>
            <br>
            <!-- ==============chart============= -->
            <div class="chart-container">
                <canvas id="myChart3" style="width:700px; height:700px;"></canvas>
                <script>
                    var ctx = document.getElementById("myChart3").getContext('2d');
                    debugger;
                    // ======= data =========
                    var data = {
                        labels: [<?php echo $timeBus_avg; ?>],
                        datasets: [

                            {
                                label: "วันจันทร์",
                                backgroundColor: 'rgb(251, 232, 102 , 0.55)',
                                borderColor: 'rgb(212, 172, 13, 0.55)',
                                data: [<?= $StimeBus_avg_Mo3; ?>],
                            },
                            {
                                label: "วันอังคาร",
                                backgroundColor: 'rgb(255, 99, 132, 0.55)',
                                borderColor: 'rgb(212, 22, 180, 0.55)',
                                data: [<?= $StimeBus_avg_Tu3; ?>],
                            },
                            {
                                label: "วันพุธ",
                                backgroundColor: 'rgb(72, 201, 176, 0.55)',
                                borderColor: 'rgb(14, 98, 81, 0.55)',
                                data: [<?= $StimeBus_avg_We3; ?>],
                            },
                            {
                                label: "วันพฤหัสบดี",
                                backgroundColor: 'rgb(235, 152, 78, 0.55)',
                                borderColor: 'rgb(175, 96, 26, 0.55)',
                                data: [<?= $StimeBus_avg_Th3; ?>],
                            },
                            {
                                label: "วันศุกร์",
                                backgroundColor: 'rgb(133, 193, 233, 0.55)',
                                borderColor: 'rgb(40, 116, 166, 0.55)',
                                data: [<?= $StimeBus_avg_Fr3; ?>],
                            },
                            {
                                label: "วันเสาร์",
                                backgroundColor: 'rgb(210, 180, 222, 0.55)',
                                borderColor: 'rgb(108, 52, 131, 0.55)',
                                data: [<?= $StimeBus_avg_Sa3; ?>],
                            },
                            {
                                label: "วันอาทิตย์sd",
                                backgroundColor: 'rgb(255, 79, 79, 0.55)',
                                borderColor: 'rgb(123, 36, 28, 0.55)',
                                data: [<?= $StimeBus_avg_Su3; ?>],
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
                                        labelString: 'เวลาเฉลี่ยในการเดินทางไปยังตึก (นาที)'
                                    }
                                }],
                                xAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'ช่วงเวลา (นาฬิกา)'
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</body>
<!-- ============= script ============= -->
<script type="text/javascript" src="vendors/js/classSchedule.js"></script>
<!-- ============= end script ============= -->

<script type="text/javascript">
    $(function() {
        $('[data-toggle="popover1"]').popover()
        $('[data-toggle="popover2"]').popover()

    })
</script>

</html>