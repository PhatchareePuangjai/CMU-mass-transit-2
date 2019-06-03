<?php

  include 'config.inc.php';

  // ดึงข้อมูลของ myChart1 กราฟแสดงจำนวนนักศึกษาในเเต่ละวัน
  //++++++++++++++++++++ ดึงข้อมูลมาจาก data base --> (classSchedule) ++++++++++++++++++++
  // ============= get datetime present =============
  date_default_timezone_set("Asia/Bangkok");
  $today = date("d/m/Y");

  
  //============= set ค่าเริ่มต้น ถ้าค้นหาค่า ให้ค่าเริ่มต้นเท่ากับค่าที่ค้นหา ถ้าไม่ set เป็นตัวเริ่ม 1 =============
  $building = "อาคารภาควิชาวิทยาการคอมพิวเตอร์";
  $semester = '1';
  $route_1 = '0';
  $route_3 = '3';
  $disabled_3 = true;
  $disabled_1 = true;
  
  // ++++++ กดเลือกอาคาร ++++++
  if(isset($_REQUEST["building"])){
    $building = $_REQUEST["building"];
  }

  //++++++ เลือกอาคารเเล้ว set เส้นทางของอาคาร ++++++
  if($building == "อาคารภาควิชาวิทยาการคอมพิวเตอร์"){
    $building_db = "Computer Science";
  }
  else{
    $building_db = "Political Science";
    $route_1 = '1';
    $route_3 = '0';
    $disabled_3 = FALSE;
    $disabled_1 = FALSE;
  }

  //++++++ กดปุ๋มค้นหา ++++++
  if(isset($_REQUEST['show'])){
    
    $building = $_REQUEST["building"];
    $semester = $_REQUEST["semester"];
    // จะเช็คสายรถ เฉพาะอาคารรัฐศาสตร์ 
    if($building == "อาคารรัฐศาสตร์"){
      if(isset($_REQUEST['route_1'])){
        $route_1 = $_REQUEST["route_1"];
      }
      // ถ้าไม่ได้เลือก สาย 1 ต้อง set เป็น 0 เพราะข้างบน set เป็น 1 ตลอด
      else{
        $route_1 = '0';
      }
      if(isset($_REQUEST['route_3'])){
        $route_3 = $_REQUEST["route_3"];
      }
      else{
        $route_3 = '0';
      }
    }
  }

  // ============= value =============
  $total_num = array(0, 0, 0, 0, 0, 0, 0); // [Mo,Tu,We,Th,Fr,Sa,Su]

  // funtion นับจำนวนที่นักศึกษาเรียนในแต่ละวัน
  function total_num($day,$total_num,$semester,$building_db) {
      
      include 'config.inc.php';

      //========================= ดึงข้อมูลมาจาก data base table --> classSchedule
      // sort ข้อมูลตามเวลาเริ่มเรียน (time_start)
      $options = array(
        "sort" => array("time_start" => 1)
      );

      $dayF = new MongoDB\BSON\Regex ($day, 'i');
      $filter = array(
        'semester' => $semester,
        'building' => $building_db,
        'day' => $dayF,
      );

      $collection = $client->timesyscmu->classSchedule;
      $result = $collection->find($filter, $options); 
      
      foreach ($result as $value) {
          // echo $value['day'];
          // echo "<br>";
          $total_num = $total_num  + $value['student_regist'];
      }
      return $total_num;
  }
  $time = array(1, 2, 3, 4, 5, 6, 7);
  // Monday -------------------
  $total_num[0] = total_num("Monday", $total_num[0], $semester, $building_db);
  // // Tuesday -------------------
  $total_num[1] = total_num("Tuesday", $total_num[1], $semester, $building_db);
  // // Wednesday -------------------
  $total_num[2] = total_num("Wednesday", $total_num[2], $semester, $building_db);
  // Thursday -------------------
  $total_num[3] = total_num("Thursday", $total_num[3], $semester, $building_db);
  // // Friday -------------------
  $total_num[4] = total_num("Friday", $total_num[4], $semester, $building_db);
  // // Saturday -----------------
  $total_num[5] = total_num("Saturday", $total_num[5], $semester, $building_db);
  // // Sunday -------------------
  $total_num[6] = total_num("Sunday", $total_num[6], $semester, $building_db);
  
  // หาจำนวนนักศึกษารวมทั้งหมด 
  $total_all = $total_num[0] + $total_num[1] + $total_num[2] + $total_num[3] + $total_num[4] + $total_num[5] + $total_num[6];

  $i = 0;
  $total_num_keep = '';
  $day_ = '';
  $day1 = ['จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์', 'อาทิตย์'];
  foreach ($total_num as $value3) {
    $day1[$i] = $day1[$i]." ( ".$value3." คน )";
    $day_ = $day_.'"'.$day1[$i].'",';
    // คิดเป็น %
    $value3 = ($value3 * 100) / $total_all; 
    // ทำเป็นทศนิยม 2 ตำแหน่ง
    $value4 = number_format($value3, 2, '.', '');
    $total_num_keep = $total_num_keep .'"'.$value4.'",';
    $i = $i + 1;
  }
  $total_num_keep = trim($total_num_keep,",");
  $day_ = trim($day_,",");

  // ===============================================================================================================================
  
  // ดึงข้อมูลของกราฟแสดงจำนวนนักศึกษา ที่เหลือ
  //++++++++++++++++++++ ดึงข้อมูลมาจาก data base --> (classSchedule_Num_Students) ++++++++++++++++++++
  // ============= get datetime present =============
  date_default_timezone_set("Asia/Bangkok");
  $today = date("d/m/Y");

  // sort ตามเวลา
  $options = array(
      "sort" => array("time" => 1),
  );
  $filter = array(
      'semester' => $semester,
      'building' => $building_db,
  );
  // ดึงข้อมูลมาจาก data base
  $collection = $client->timesyscmu->classSchedule_Num_Students;
  $result = $collection->find($filter, $options);  
  

  $numStart = '';
  $numEnd = '';

  // ============= value =============
  $time_Mo = '';
  $numStudents_Mo = '';
  $time_Start_Mo = '';
  $time_End_Mo = '';
  // ------------------
  $time_Tu = '';
  $numStudents_Tu = '';
  $time_Start_Tu = '';
  $time_End_Tu = '';
  // ------------------
  $time_We = '';
  $numStudents_We = '';
  $time_Start_We = '';
  $time_End_We = '';
  // ------------------
  $time_Th = '';
  $numStudents_Th = '';
  $time_Start_Th = '';
  $time_End_Th = '';
  // ------------------
  $time_Fr = '';
  $numStudents_Fr = '';
  $time_Start_Fr = '';
  $time_End_Fr = '';
  // ------------------
  $time_Sa = '';
  $numStudents_Sa = '';
  $time_Start_Sa = '';
  $time_End_Sa = '';
  // ------------------
  $time_Su = '';
  $numStudents_Su = '';
  $time_Start_Su = '';
  $time_End_Su = '';
  // ------------------
  $time_chart = '';
  // ============= วนแยกแต่ละวัน =============

  foreach ($result as $value) {

      // นับจำนวน น.ศ. ที่มาเรียนทั้งหมดของวัน
      if($value['day'] == 'Monday'){
          $time_chart = $time_chart .'"'. $value['time']   .'",';
          $numStudents_Mo = $numStudents_Mo .'"'. $value['numStudents']   .'",';
          $time_Start_Mo = $time_Start_Mo .'"'. $value['numStudentsStart']   .'",';
          $time_End_Mo = $time_End_Mo .'"'. $value['numStudentsEnd']   .'",';
      }
      elseif($value['day'] == 'Tuesday'){
          $numStudents_Tu = $numStudents_Tu .'"'. $value['numStudents']   .'",';
          $time_Start_Tu = $time_Start_Tu .'"'. $value['numStudentsStart']   .'",';
          $time_End_Tu = $time_End_Tu .'"'. $value['numStudentsEnd']   .'",';
      }
      elseif($value['day'] == 'Wednesday'){
          $numStudents_We = $numStudents_We .'"'. $value['numStudents']   .'",';
          $time_Start_We = $time_Start_We .'"'. $value['numStudentsStart']   .'",';
          $time_End_We = $time_End_We .'"'. $value['numStudentsEnd']   .'",';
      }
      elseif($value['day'] == 'Thursday'){
          $numStudents_Th = $numStudents_Th .'"'. $value['numStudents']   .'",';
          $time_Start_Th = $time_Start_Th .'"'. $value['numStudentsStart']   .'",';
          $time_End_Th = $time_End_Th .'"'. $value['numStudentsEnd']   .'",';
      }
      elseif($value['day'] == 'Friday'){
          $numStudents_Fr = $numStudents_Fr .'"'. $value['numStudents']   .'",';
          $time_Start_Fr = $time_Start_Fr .'"'. $value['numStudentsStart']   .'",';
          $time_End_Fr = $time_End_Fr .'"'. $value['numStudentsEnd']   .'",';
      }
      elseif($value['day'] == 'Saturday'){
          $numStudents_Sa = $numStudents_Sa .'"'. $value['numStudents']   .'",';
          $time_Start_Sa = $time_Start_Sa .'"'. $value['numStudentsStart']   .'",';
          $time_End_Sa = $time_End_Sa .'"'. $value['numStudentsEnd']   .'",';
      }
      elseif($value['day'] == 'Sunday'){
          $numStudents_Su = $numStudents_Su .'"'. $value['numStudents']   .'",';
          $time_Start_Su = $time_Start_Su .'"'. $value['numStudentsStart']   .'",';
          $time_End_Su = $time_End_Su .'"'. $value['numStudentsEnd']   .'",';
      }
      $i = $i + 1;
  }
  
  // ============= เป็น str ที่มี ',' หัวท้ายเลยต้องตัด ',' หัวท้ายออก =============
  $time_chart = trim($time_chart,",");
  $numStudents_Mo = trim($numStudents_Mo,",");
  $time_Start_Mo = trim($time_Start_Mo,",");
  $time_End_Mo = trim($time_End_Mo,",");

  $numStudents_Tu = trim($numStudents_Tu,",");
  $time_Start_Tu = trim($time_Start_Tu,",");
  $time_End_Tu = trim($time_End_Tu,",");

  $numStudents_We = trim($numStudents_We,",");
  $time_Start_We = trim($time_Start_We,",");
  $time_End_We = trim($time_End_We,",");

  $numStudents_Th = trim($numStudents_Th,",");
  $time_Start_Th = trim($time_Start_Th,",");
  $time_End_Th = trim($time_End_Th,",");

  $numStudents_Fr = trim($numStudents_Fr,",");
  $time_Start_Fr = trim($time_Start_Fr,",");
  $time_End_Fr = trim($time_End_Fr,",");

  $numStudents_Sa = trim($numStudents_Sa,",");
  $time_Start_Sa = trim($time_Start_Sa,",");
  $time_End_Sa = trim($time_End_Sa,",");

  $numStudents_Su = trim($numStudents_Su,",");
  $time_Start_Su = trim($time_Start_Su,",");
  $time_End_Su = trim($time_End_Su,",");



  // header("location: ../classSchedule.php");
  // คำนวณ +==========================
   //============= set ค่าเริ่มต้น ถ้าค้นหาค่า ให้ค่าเริ่มต้นเท่ากับค่าที่ค้นหา ถ้าไม่ set เป็นตัวเริ่ม 1 =============
   
  
  //  // เก็บเวลาเฉลี่ยในการเดินทาง ทั้งสาย 1 และ สาย 3
  //  $averagetime_1 = '';
  //  $averagetime_3 = '';
   $timeBus_avg_1  = new ArrayObject(array());
   $timeBus_avg_3  = new ArrayObject(array());

   $count_numBus = new ArrayObject(array());
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
       $numStart = $time_Start_Mo;
       $numEnd = $time_End_Mo;
       $daySelect_thai = "วันจันทร์";
       $daySelect2 = 'Monday';
   }
   elseif($date_p == "Tue"){
        $numStart = $time_Start_Tu;
        $numEnd = $time_End_Tu;
       $daySelect_thai = "วันอังคาร";
       $daySelect2 = "Tuesday";
   }
   elseif($date_p == "Wed"){
        $numStart = $time_Start_We;
        $numEnd = $time_End_We;
       $daySelect_thai = "วันพุธ";
       $daySelect2 = "Wednesday";
   }
   elseif($date_p == "Thu"){
        $numStart = $time_Start_Th;
        $numEnd = $time_End_Th;
       $daySelect_thai = "วันพฤหัสบดี";
       $daySelect2 = "Thursday";
   }
   elseif($date_p == "Fri"){
        $numStart = $time_Start_Fr;
        $numEnd = $time_End_Fr;
       $daySelect_thai = "วันศุกร์";
       $daySelect2 = "Friday";
   }
   elseif($date_p == "Sat"){
        $numStart = $time_Start_Sa;
        $numEnd = $time_End_Sa;
       $daySelect_thai = "วันเสาร์";
       $daySelect2 = "Saturday";
   }
   else{
        $numStart = $time_Start_Su;
        $numEnd = $time_End_Su;
       $daySelect_thai = "วันอาทิตย์";
       $daySelect2 = "Sunday";
   }


   if(isset($_REQUEST["daySelect_thai"])){
       $daySelect_thai = $_REQUEST["daySelect_thai"];
   }

   if($daySelect_thai == "วันจันทร์"){
        $numStart = $time_Start_Mo;
        $numEnd = $time_End_Mo;
        $daySelect2 = 'Monday';
   }
   elseif($daySelect_thai == "วันอังคาร"){
        $numStart = $time_Start_Tu;
        $numEnd = $time_End_Tu;
       $daySelect2 = "Tuesday";
   }
   elseif($daySelect_thai == "วันพุธ"){
        $numStart = $time_Start_We;
        $numEnd = $time_End_We;
       $daySelect2 = "Wednesday";
   }
   elseif($daySelect_thai == "วันพฤหัสบดี"){
        $numStart = $time_Start_Th;
        $numEnd = $time_End_Th;
       $daySelect2 = "Thursday";
   }
   elseif($daySelect_thai == "วันศุกร์"){
        $numStart = $time_Start_Fr;
        $numEnd = $time_End_Fr;
       $daySelect2 = "Friday";
   }
   elseif($daySelect_thai == "วันเสาร์"){
        $numStart = $time_Start_Sa;
        $numEnd = $time_End_Sa;
       $daySelect2 = "Saturday";
   }
   else{
        $numStart = $time_Start_Su;
        $numEnd = $time_End_Su;
       $daySelect2 = "Sunday";
   }

   if($building == "อาคารภาควิชาวิทยาการคอมพิวเตอร์"){
    $timeBus_avg_3 = detDataDay($building, $daySelect2, $timeBus_avg_3, $count_numBus, '3');
   }else{
    $timeBus_avg_1 = detDataDay($building, $daySelect2, $timeBus_avg_1, $count_numBus, '1');
    $timeBus_avg_3 = detDataDay($building, $daySelect2, $timeBus_avg_3, $count_numBus, '3');
   }


   
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
   $time_diff = $timeBus_avg_1[$time_index];
   if($building == "อาคารภาควิชาวิทยาการคอมพิวเตอร์"){
    $route_cal = '3';
    $time_diff = $timeBus_avg_3[$time_index];
   }

   $keep_alerttime = 0;
   $time_P2 = date('H:i');
   $time_cal = date('H:i', strtotime('+30 minutes', strtotime($time_P2)));
   $time_start = date('H:i', strtotime('-'.$time_diff.' minutes', strtotime($time_cal)));    



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
           $time_start = date('H:i', strtotime('-'.$time_diff.' minutes', strtotime($time_cal)));
       }
   }

   if(strtotime($time_start) - strtotime($time_P2) < 0){
       $keep_alerttime = 1;
   }



  // ============================ กดคำนวณอันที่สอง ============================

  // ทำเวลาที่นักศึกษาเริ่มเรียน เเละเลิกเรียนเป็น array 
  $arr_numStart = explode(',', $numStart);
  $arr_numEnd = explode(',', $numEnd);
  $arr_time_chart = explode(',', $time_chart);
  

  $time_c = number_format(date("H.i"), 2);
    //   test
    //   $time_c = 12.00;
  $keep_ = 0;
  $time_index_class = -1;

  for( $i = 0; $i < 23; $i++ ) {
                          
    $keep = trim($arr_time_chart[$i],'"');
    $keep_next = number_format(str_replace(':','.',$keep), 2);

    // เลือกเวลาที่มากกว่าเวลาจิง 
    if($time_c < $keep_next && $keep_ == 0){
        $keep_ = 1;
        $time_index_class = $i;
    }
  }

  if($time_index_class == -1){
    $numStudent = 0;
  }else{
 
    // เลือกเวลาตามเวลาปัจจุบันเเละทำเป็น int   
    $arr_numStart1 = trim(($arr_numStart[$time_index_class]),'"');
    $arr_numEnd1 = trim(($arr_numEnd[$time_index_class]),'"');

    $numStudent = max($arr_numStart1 , $arr_numEnd1 );
  }



  $time_q = date('H:i', strtotime('+30 minutes', strtotime($time_P2)));
  $time_start2 = date('H:i', strtotime('+5minutes', strtotime($time_P2)));  
  $numBus = 0;
  $time_q_ans = 0;
  $hour = 0;
  $minute = 0;
  $second = 0;

//   กรณีเข้ามาในโปรเเกรมจะคิดจากตารางเรียนเลย
  if($numStudent != 0){
    $numStudent2 = number_format($numStudent, 2);
    $numBus = $numStudent2 / 13.0;

    if($numBus > 1){
        $time_q_ans = (strtotime($time_q) - strtotime($time_start2)) / $numBus;
    
        $hour=floor($time_q_ans/3600);
        $l_hour=$time_q_ans%3600;
        $minute=floor($l_hour/60);
        $second=$l_hour%60;
    }
  }
  
  if(isset($_REQUEST['cal2'])){

    if(isset($_REQUEST['route_cal'])){
      $route_cal = $_REQUEST["route_cal"];
    }  

    if(isset($_REQUEST['time_q'])){
      $time_q = $_REQUEST["time_q"];
      if(isset($_REQUEST['numStudent'])){
        $numStudent = $_REQUEST["numStudent"];
        $numStudent2 = number_format($numStudent, 2);
        $numBus = $numStudent2 / 13.0;

        if($numBus > 1){
            $time_q_ans = (strtotime($time_q) - strtotime($time_start2)) / $numBus;
        
            $hour=floor($time_q_ans/3600);
            $l_hour=$time_q_ans%3600;
            $minute=floor($l_hour/60);
            $second=$l_hour%60;
        }
 
      }
    }  
  }
