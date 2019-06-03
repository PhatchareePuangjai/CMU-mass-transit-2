<?php

    //========= include =========
    include 'config.inc.php';

 	// ============= get datetime present =============
    date_default_timezone_set("Asia/Bangkok");
    $today = "14/02/2019";

    //============= set ค่าเริ่มต้น ถ้าค้นหาค่า ให้ค่าเริ่มต้นเท่ากับค่าที่ค้นหา ถ้าไม่ set เป็นตัวเริ่ม 1 =============
    $daySelect = $today;
    $building = "สถานีบริการหน้ามหาวิทยาลัย";
    
    // ++++++ กดเลือกอาคาร ++++++
    if(isset($_REQUEST["building"])){
        $building = $_REQUEST["building"];
    }

    if(isset($_REQUEST['daySelect'])){
        $daySelect = $_REQUEST["daySelect"];
        // $building = $_REQUEST["building"];
    }     
    


    //========= กดปุ๋มค้นหา =========
    if(isset($_REQUEST['show'])){
        if(isset($_REQUEST['daySelect'])){
            $daySelect = $_REQUEST["daySelect"];
        }     
    }

    //========= แปรค่าจากวันที่ ที่ใช้ค้นหาเป็น รูปแบบตาม Data Base =========
    $daySelect_ = explode("/", $daySelect);
    $daySelect_DB = $daySelect_[2] . '-' . $daySelect_[1] . '-' . $daySelect_[0]; 

    //========= sort ข้อมูลตามเวลาเริ่มเรียน (timestamp) =========
    $options = array(
        // ถ้าเป็น 1 (น้อย -> มาก)
        // ถ้าเป็น -1 (มาก -> น้อย)
        "sort" => array("timestamp" => 1)
    );

    $dayF = new MongoDB\BSON\Regex ($daySelect_DB, 'i');

    $filter = array(
        'timestamp' => $dayF,
        'place' => $building,
    );
    
    $collection = $client->timesyscmu->transit_Average_Time_Final;
    // ========================== select table ==========================
    $result = $collection->find($filter, $options); 

    //========================== value ==========================
    $time_chart = '';
    // เก็บเวลาเฉลี่ยในการเดินทาง ทั้งสาย 1 และ สาย 3
    $averagetime_1 = '';
    $averagetime_3 = '';
    $timeBus_avg_1  = new ArrayObject(array());
    $timeBus_avg_3  = new ArrayObject(array());

    $count_numBus = new ArrayObject(array());

    // ==============จัดรูป เพื่อนำไปเเสดงกราฟ เวลาเฉลี่ยในการเดินทาง ================
    foreach ($result as $value) {
   
        // จัดเก็บเวลาเฉลี่ยในการเดินทางของสาย 1
        if($value['route'] == '1'){
            // จัดเก็บช่วงเวลาของกราฟ
            $keep_time = $value['timeStart'] . ' - ' .$value['timeEnd'];
            $time_chart = $time_chart .'"'. $keep_time   .'",';

            $averagetime_1 = $averagetime_1 .'"'. $value['averagetime'] .'",';
        }
        // จัดเก็บเวลาเฉลี่ยในการเดินทางของสาย 3
        if($value['route'] == '3'){
            $averagetime_3 = $averagetime_3 .'"'. $value['averagetime'] .'",';
        }

    }

    // ============= เป็น str ที่มี ',' หัวท้ายเลยต้องตัด ',' หัวท้ายออก =============
    $time_chart = trim($time_chart,",");
    $averagetime_1 = trim($averagetime_1,",");
    $averagetime_3 = trim($averagetime_3,",");

    // ========================== คำนวณหาเวลาเฉลี่ยในการเดินทางของเเต่ละวัน ในเเต่ละช่วงเวลา ==========================

    function detDataDay($building, $day, $timeBus_avg, $count_numBus, $route) {
        
        include 'config.inc.php';

        $options = array(
            "sort" => array("timestamp" => 1)
        );

        $collection = $client->timesyscmu->transit_Average_Time_Final;
        // ========================== select table ==========================
        
        $keep_time = ['07:00', '08:01', '09:31', '11:01', '12:31', '13:01', '14:31', '16:01', '17:31', '19:01', '20:31'];

        // set นับให้เป็น 0
        for( $i = 0; $i < 11; $i++ ) {
            $count_numBus[$i] = 0;
            // set value
        }

        for( $i = 0; $i < 11; $i++ ) {

            $filter1 = array(
                'day' => $day,
                'place' => $building,
                'timeStart' => $keep_time[$i],
                'route' => $route
            );

            $result = $collection->find($filter1, $options); 

            foreach ($result as $value) {
                $count_numBus[$i] = $count_numBus[$i] + 1;
                $timeBus_avg[$i] = $timeBus_avg[$i] + $value['averagetime'];
            }

            $timeBus_avg[$i] = ceil($timeBus_avg[$i] / $count_numBus[$i]);
        }
        return $timeBus_avg;

    }
    
    $date_p = date("D");
    $time_p = number_format(date("H.i"), 2);
    $time_index = 0;

    $time_star1 = ['07:00', '08:01', '09:31', '11:01', '12:31', '13:01', '14:31', '16:01', '17:31', '19:01', '20:31'];
    $time_end1 =  ['08:00', '09:30', '11:00', '12:30', '13:00', '14:30', '16:00', '17:30', '19:00', '20:30', '22:00']; 
    $timeBus_avg = '';
    

    for( $i = 0; $i < 11; $i++ ) {
        $keep = $time_star1[$i] . ' - ' .$time_end1[$i];
        $timeBus_avg = $timeBus_avg .'"'. $keep   .'",';



        $keep_start = number_format(str_replace(':','.',$time_star1[$i]), 2);
        $keep_end = number_format(str_replace(':','.',$time_end1[$i]), 2);
        if($time_p >= $keep_start && $time_p <= $keep_end){
            $time_index = $i;
        }

        $count_numBus->append(0);
        $timeBus_avg_1 ->append(0);
        $timeBus_avg_3 ->append(0);     
    }
 



    if($date_p == "Mon"){
        $daySelect_thai = "วันจันทร์";
        $daySelect2 = 'Monday';
    }
    elseif($date_p == "Tue"){
        $daySelect_thai = "วันอังคาร";
        $daySelect2 = "Tuesday";
    }
    elseif($date_p == "Wed"){
        $daySelect_thai = "วันพุธ";
        $daySelect2 = "Wednesday";
    }
    elseif($date_p == "Thu"){
        $daySelect_thai = "วันพฤหัสบดี";
        $daySelect2 = "Thursday";
    }
    elseif($date_p == "Fri"){
        $daySelect_thai = "วันศุกร์";
        $daySelect2 = "Friday";
    }
    elseif($date_p == "Sat"){
        $daySelect_thai = "วันเสาร์";
        $daySelect2 = "Saturday";
    }
    else{
        $daySelect_thai = "วันอาทิตย์";
        $daySelect2 = "Sunday";
    }


    if(isset($_REQUEST["daySelect_thai"])){
        $daySelect_thai = $_REQUEST["daySelect_thai"];
    }

    if($daySelect_thai == "วันจันทร์"){
        $daySelect2 = 'Monday';
    }
    elseif($daySelect_thai == "วันอังคาร"){
        $daySelect2 = "Tuesday";
    }
    elseif($daySelect_thai == "วันพุธ"){
        $daySelect2 = "Wednesday";
    }
    elseif($daySelect_thai == "วันพฤหัสบดี"){
        $daySelect2 = "Thursday";
    }
    elseif($daySelect_thai == "วันศุกร์"){
        $daySelect2 = "Friday";
    }
    elseif($daySelect_thai == "วันเสาร์"){
        $daySelect2 = "Saturday";
    }
    else{
        $daySelect2 = "Sunday";
    }

    $timeBus_avg_1 = detDataDay($building, $daySelect2, $timeBus_avg_1, $count_numBus, '1');
    $timeBus_avg_3 = detDataDay($building, $daySelect2, $timeBus_avg_3, $count_numBus, '3');

    
    // value string
    $timeBus_avg_1_s = '';
    $timeBus_avg_3_s = '';

    for( $i = 0; $i < 11; $i++ ) {
        $timeBus_avg_1_s = $timeBus_avg_1_s .'"'. $timeBus_avg_1[$i]   .'",';
        $timeBus_avg_3_s = $timeBus_avg_3_s .'"'. $timeBus_avg_3[$i]   .'",';
    }

    $timeBus_avg = trim($timeBus_avg,",");
    $timeBus_avg_1_s = trim($timeBus_avg_1_s,",");
    $timeBus_avg_3_s = trim($timeBus_avg_3_s,",");

    
    //============================== คำนวณ =======================================
    // กำหนดค่าให้ route เท่ากับ 1 เสมอก่อน
    $route_cal = '1';
    $keep_alerttime = 0;
    $time_diff = $timeBus_avg_1[$time_index];
    $time_P = date('H.i');
    $time_cal = date('H.i', strtotime('+30 minutes', strtotime($time_P)));
    $time_start = date('H.i', strtotime('-'.$time_diff.' minutes', strtotime($time_cal)));    



    if(isset($_REQUEST['cal'])){

        if(isset($_REQUEST['route_cal'])){
            $route_cal = $_REQUEST["route_cal"];
        }     
        if(isset($_REQUEST['time_cal'])){
            $time_cal = $_REQUEST["time_cal"];

            if($route_cal == '1'){
                $time_diff = $timeBus_avg_1[$time_index];
            }else{
                $time_diff = $timeBus_avg_3[$time_index];
            }
            $time_start = date('H.i', strtotime('-'.$time_diff.' minutes', strtotime($time_cal)));
        }
    }

    if(strtotime($time_start) - strtotime($time_P) < 0){
        $keep_alerttime = 1;
    }
 

    
?>