 <?php

    //========= include =========
    include 'config.inc.php';

 	// ============= get datetime present =============
    date_default_timezone_set("Asia/Bangkok");
    // $today = date("d-m-Y");
    $today = "14/02/2019";

    //============= set ค่าเริ่มต้น ถ้าค้นหาค่า ให้ค่าเริ่มต้นเท่ากับค่าที่ค้นหา ถ้าไม่ set เป็นตัวเริ่ม 1 =============
    $route_1 = '0';
    $route_3 = '3';
    $daySelect = $today;
    $distanceTime = "ช่วงเช้า (07:00 - 10:00 น.)";
    $timeSpacing = "2 นาที";

    //========= รับค่าจากเส้นทางรถ =========
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

    // ถ้าไม่ได้เลือกเส้นทางเเต่กด ค้นหาค่าเส้นทางจะถูกเลือกอัตโนมัติ ให้เท่ากับสาย 1
    if($route_1 == '0' && $route_3 == '0'){
        $route_1 = '1';
    }

    //========= กดปุ๋มค้นหา =========
    if(isset($_REQUEST['show'])){
        if(isset($_REQUEST['daySelect'])){
            $daySelect = $_REQUEST["daySelect"];
        }     
    }

  

    // ========= กดค้นหาช่วงเวลาของวัน =========
    if(isset($_REQUEST['distanceTime'])){
        $distanceTime = $_REQUEST["distanceTime"];

        if(isset($_REQUEST['daySelect'])){
            $daySelect = $_REQUEST["daySelect"];
        }
        if(isset($_REQUEST['route_1'])){
            $route_1 = $_REQUEST["route_1"];
        }
        if(isset($_REQUEST['route_3'])){
            $route_3 = $_REQUEST["route_3"];
        }

    }

    if(isset($_REQUEST['timeSpacing'])){
        $timeSpacing = $_REQUEST["timeSpacing"];
    }

    //========= แปรค่าจากวันที่ ที่ใช้ค้นหาเป็น รูปแบบตาม Data Base =========
    $daySelect2 = explode("/", $daySelect);
    $daySelect_DB = $daySelect2[2] . '-' . $daySelect2[1] . '-' . $daySelect2[0]; 

    //========= ทดสอบ =========
    // $daySelect_DB = $daySelect_DB . 'T10';
    // 2019-02-14
    //========================= ดึงข้อมูลมาจาก data base table --> classSchedule
    // sort ข้อมูลตามเวลาเริ่มเรียน (timestamp)
    $options = array(
        // ถ้าเป็น 1 (น้อย -> มาก)
        // ถ้าเป็น -1 (มาก -> น้อย)
        "sort" => array("timestamp" => 1)
    );
    



    $dayF = new MongoDB\BSON\Regex ($daySelect_DB, 'i');
    // สาย 1 อย่างเดียว
    if($route_1 == '1' && $route_3 != '3'){
        
        $filter = array(
            'timestamp' => $dayF,
            'route' => (int)$route_1,
        );

        if($distanceTime == "ช่วงเช้า (07:00 - 10:00 น.)"){

            $dayStart1 = $daySelect_DB . 'T07';
            $dayStart2 = $daySelect_DB . 'T08';
            $dayStart3 = $daySelect_DB . 'T09';
            $dayStart4 = $daySelect_DB . 'T10';
       

            $dayStart1F = new MongoDB\BSON\Regex ($dayStart1, 'i');
            $dayStart2F = new MongoDB\BSON\Regex ($dayStart2, 'i');
            $dayStart3F = new MongoDB\BSON\Regex ($dayStart3, 'i');
            $dayStart4F = new MongoDB\BSON\Regex ($dayStart4, 'i');
      

            $filter1 = array('$and' =>
                array(
                    array('route' => (int)$route_1),
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart1F),
                            array('timestamp' => $dayStart2F),
                            array('timestamp' => $dayStart3F),
                            array('timestamp' => $dayStart4F),
                    
                        ),
                    ),
                ),
            );
        }
        elseif($distanceTime == "ช่วงเทียง (11:00 - 13:00 น.)"){

           
            $dayStart1 = $daySelect_DB . 'T12';
            $dayStart2 = $daySelect_DB . 'T13';
            $dayStart3 = $daySelect_DB . 'T11';
    

            $dayStart1F = new MongoDB\BSON\Regex ($dayStart1, 'i');
            $dayStart2F = new MongoDB\BSON\Regex ($dayStart2, 'i');
            $dayStart3F = new MongoDB\BSON\Regex ($dayStart3, 'i');
         

            $filter1 = array('$and' =>
                array(
                    array('route' => (int)$route_1),
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart1F),
                            array('timestamp' => $dayStart2F),
                            array('timestamp' => $dayStart3F),
                        ),
                    ),
                ),
            );
        }
        elseif($distanceTime == "ช่วงบ่าย (14:00 - 16:00 น.)"){

           
            $dayStart1 = $daySelect_DB . 'T14';
            $dayStart2 = $daySelect_DB . 'T15';
            $dayStart3 = $daySelect_DB . 'T16';
    

            $dayStart1F = new MongoDB\BSON\Regex ($dayStart1, 'i');
            $dayStart2F = new MongoDB\BSON\Regex ($dayStart2, 'i');
            $dayStart3F = new MongoDB\BSON\Regex ($dayStart3, 'i');
         

            $filter1 = array('$and' =>
                array(
                    array('route' => (int)$route_1),
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart1F),
                            array('timestamp' => $dayStart2F),
                            array('timestamp' => $dayStart3F),
                        ),
                    ),
                ),
            );
        }
        elseif($distanceTime == "ช่วงเย็น (17:00 - 19:00 น.)"){

           
            $dayStart1 = $daySelect_DB . 'T17';
            $dayStart2 = $daySelect_DB . 'T18';
            $dayStart3 = $daySelect_DB . 'T19';
    

            $dayStart1F = new MongoDB\BSON\Regex ($dayStart1, 'i');
            $dayStart2F = new MongoDB\BSON\Regex ($dayStart2, 'i');
            $dayStart3F = new MongoDB\BSON\Regex ($dayStart3, 'i');
         

            $filter1 = array('$and' =>
                array(
                    array('route' => (int)$route_1),
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart1F),
                            array('timestamp' => $dayStart2F),
                            array('timestamp' => $dayStart3F),
                        ),
                    ),
                ),
            );
        }
        else{
        

            $dayStart4 = $daySelect_DB . 'T20';
            $dayStart5 = $daySelect_DB . 'T21';
            $dayStart6 = $daySelect_DB . 'T22';

         
            $dayStart4F = new MongoDB\BSON\Regex ($dayStart4, 'i');
            $dayStart5F = new MongoDB\BSON\Regex ($dayStart5, 'i');
            $dayStart6F = new MongoDB\BSON\Regex ($dayStart6, 'i');

            $filter1 = array('$and' =>
                array(
                    array('route' => (int)$route_1),
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart4F),
                            array('timestamp' => $dayStart5F),
                            array('timestamp' => $dayStart6F),
                        ),
                    ),
                ),
            );
            
        }
    }
    // สาย 3 อย่างเดียว
    elseif($route_3 == '3' && $route_1 != '1'){
        $filter = array(
            'timestamp' => $dayF,
            'route' => (int)$route_3,
        );

        if($distanceTime == "ช่วงเช้า (07:00 - 10:00 น.)"){

            $dayStart1 = $daySelect_DB . 'T07';
            $dayStart2 = $daySelect_DB . 'T08';
            $dayStart3 = $daySelect_DB . 'T09';
            $dayStart4 = $daySelect_DB . 'T10';
       

            $dayStart1F = new MongoDB\BSON\Regex ($dayStart1, 'i');
            $dayStart2F = new MongoDB\BSON\Regex ($dayStart2, 'i');
            $dayStart3F = new MongoDB\BSON\Regex ($dayStart3, 'i');
            $dayStart4F = new MongoDB\BSON\Regex ($dayStart4, 'i');
      

            $filter1 = array('$and' =>
                array(
                    array('route' => (int)$route_3),
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart1F),
                            array('timestamp' => $dayStart2F),
                            array('timestamp' => $dayStart3F),
                            array('timestamp' => $dayStart4F),
                    
                        ),
                    ),
                ),
            );
        }
        elseif($distanceTime == "ช่วงเทียง (11:00 - 13:00 น.)"){

           
            $dayStart1 = $daySelect_DB . 'T12';
            $dayStart2 = $daySelect_DB . 'T13';
            $dayStart3 = $daySelect_DB . 'T11';
    

            $dayStart1F = new MongoDB\BSON\Regex ($dayStart1, 'i');
            $dayStart2F = new MongoDB\BSON\Regex ($dayStart2, 'i');
            $dayStart3F = new MongoDB\BSON\Regex ($dayStart3, 'i');
         

            $filter1 = array('$and' =>
                array(
                    array('route' => (int)$route_3),
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart1F),
                            array('timestamp' => $dayStart2F),
                            array('timestamp' => $dayStart3F),
                        ),
                    ),
                ),
            );
        }
        elseif($distanceTime == "ช่วงบ่าย (14:00 - 16:00 น.)"){

           
            $dayStart1 = $daySelect_DB . 'T14';
            $dayStart2 = $daySelect_DB . 'T15';
            $dayStart3 = $daySelect_DB . 'T16';
    

            $dayStart1F = new MongoDB\BSON\Regex ($dayStart1, 'i');
            $dayStart2F = new MongoDB\BSON\Regex ($dayStart2, 'i');
            $dayStart3F = new MongoDB\BSON\Regex ($dayStart3, 'i');
         

            $filter1 = array('$and' =>
                array(
                    array('route' => (int)$route_3),
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart1F),
                            array('timestamp' => $dayStart2F),
                            array('timestamp' => $dayStart3F),
                        ),
                    ),
                ),
            );
        }
        elseif($distanceTime == "ช่วงเย็น (17:00 - 19:00 น.)"){

           
            $dayStart1 = $daySelect_DB . 'T17';
            $dayStart2 = $daySelect_DB . 'T18';
            $dayStart3 = $daySelect_DB . 'T19';
    

            $dayStart1F = new MongoDB\BSON\Regex ($dayStart1, 'i');
            $dayStart2F = new MongoDB\BSON\Regex ($dayStart2, 'i');
            $dayStart3F = new MongoDB\BSON\Regex ($dayStart3, 'i');
         

            $filter1 = array('$and' =>
                array(
                    array('route' => (int)$route_3),
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart1F),
                            array('timestamp' => $dayStart2F),
                            array('timestamp' => $dayStart3F),
                        ),
                    ),
                ),
            );
        }      
        else{
        

            $dayStart4 = $daySelect_DB . 'T20';
            $dayStart5 = $daySelect_DB . 'T21';
            $dayStart6 = $daySelect_DB . 'T22';

         
            $dayStart4F = new MongoDB\BSON\Regex ($dayStart4, 'i');
            $dayStart5F = new MongoDB\BSON\Regex ($dayStart5, 'i');
            $dayStart6F = new MongoDB\BSON\Regex ($dayStart6, 'i');

            $filter1 = array('$and' =>
                array(
                    array('route' => (int)$route_3),
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart4F),
                            array('timestamp' => $dayStart5F),
                            array('timestamp' => $dayStart6F),
                        ),
                    ),
                ),
            );
            
        }
    }
    else{
        $filter = array(
            'timestamp' => $dayF,
        );
        if($distanceTime == "ช่วงเช้า (07:00 - 10:00 น.)"){

            $dayStart1 = $daySelect_DB . 'T07';
            $dayStart2 = $daySelect_DB . 'T08';
            $dayStart3 = $daySelect_DB . 'T09';
            $dayStart4 = $daySelect_DB . 'T10';
       

            $dayStart1F = new MongoDB\BSON\Regex ($dayStart1, 'i');
            $dayStart2F = new MongoDB\BSON\Regex ($dayStart2, 'i');
            $dayStart3F = new MongoDB\BSON\Regex ($dayStart3, 'i');
            $dayStart4F = new MongoDB\BSON\Regex ($dayStart4, 'i');
      

            $filter1 = array('$and' =>
                array(
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart1F),
                            array('timestamp' => $dayStart2F),
                            array('timestamp' => $dayStart3F),
                            array('timestamp' => $dayStart4F),
                    
                        ),
                    ),
                ),
            );
        }
        elseif($distanceTime == "ช่วงเทียง (11:00 - 13:00 น.)"){

           
            $dayStart1 = $daySelect_DB . 'T12';
            $dayStart2 = $daySelect_DB . 'T13';
            $dayStart3 = $daySelect_DB . 'T11';
    

            $dayStart1F = new MongoDB\BSON\Regex ($dayStart1, 'i');
            $dayStart2F = new MongoDB\BSON\Regex ($dayStart2, 'i');
            $dayStart3F = new MongoDB\BSON\Regex ($dayStart3, 'i');
         

            $filter1 = array('$and' =>
                array(
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart1F),
                            array('timestamp' => $dayStart2F),
                            array('timestamp' => $dayStart3F),
                        ),
                    ),
                ),
            );
        }
        elseif($distanceTime == "ช่วงบ่าย (14:00 - 16:00 น.)"){

           
            $dayStart1 = $daySelect_DB . 'T14';
            $dayStart2 = $daySelect_DB . 'T15';
            $dayStart3 = $daySelect_DB . 'T16';
    

            $dayStart1F = new MongoDB\BSON\Regex ($dayStart1, 'i');
            $dayStart2F = new MongoDB\BSON\Regex ($dayStart2, 'i');
            $dayStart3F = new MongoDB\BSON\Regex ($dayStart3, 'i');
         

            $filter1 = array('$and' =>
                array(
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart1F),
                            array('timestamp' => $dayStart2F),
                            array('timestamp' => $dayStart3F),
                        ),
                    ),
                ),
            );
        }
        elseif($distanceTime == "ช่วงเย็น (17:00 - 19:00 น.)"){

           
            $dayStart1 = $daySelect_DB . 'T17';
            $dayStart2 = $daySelect_DB . 'T18';
            $dayStart3 = $daySelect_DB . 'T19';
    

            $dayStart1F = new MongoDB\BSON\Regex ($dayStart1, 'i');
            $dayStart2F = new MongoDB\BSON\Regex ($dayStart2, 'i');
            $dayStart3F = new MongoDB\BSON\Regex ($dayStart3, 'i');
         

            $filter1 = array('$and' =>
                array(
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart1F),
                            array('timestamp' => $dayStart2F),
                            array('timestamp' => $dayStart3F),
                        ),
                    ),
                ),
            );
        }      
        else{
        

            $dayStart4 = $daySelect_DB . 'T20';
            $dayStart5 = $daySelect_DB . 'T21';
            $dayStart6 = $daySelect_DB . 'T22';

         
            $dayStart4F = new MongoDB\BSON\Regex ($dayStart4, 'i');
            $dayStart5F = new MongoDB\BSON\Regex ($dayStart5, 'i');
            $dayStart6F = new MongoDB\BSON\Regex ($dayStart6, 'i');

            $filter1 = array('$and' =>
                array(
                    array('$or' =>
                        array(
                            array('timestamp' => $dayStart4F),
                            array('timestamp' => $dayStart5F),
                            array('timestamp' => $dayStart6F),
                        ),
                    ),
                ),
            );
            
        }
    }


    $collection = $client->timesyscmu->transit;
    // ========================== select table ==========================
    $result = $collection->find($filter, $options); 

    //========================== select chart 1 ==========================
    $result2 = $collection->find($filter1, $options); 
    $result3 = $collection->find($filter1, $options); 

    $time_chart = array();
    $count_bus1 = array();
    $max_peopleInbus1 = array();
    $count_bus3 = array();
    $max_peopleInbus3 = array();

    // ตัวเเปรที่นั่งที่ว่าง
    $num_seat1 = array();
    $num_seat3 = array();
    $width_chart = '4000px';

    if($timeSpacing == "2 นาที"){
        $timeSpacing_cal = 2;
    }elseif($timeSpacing == "4 นาที"){
        $width_chart = "3000px";
        $timeSpacing_cal = 4;
    }
    elseif($timeSpacing == "6 นาที"){
        $width_chart = "2000px";
        $timeSpacing_cal = 6;
    }
    elseif($timeSpacing == "8 นาที"){
        $width_chart = "1800px";
        $timeSpacing_cal = 8;
    }
    else{
        $width_chart = "1100px";
        $timeSpacing_cal = 10;
    }
    // วนลูปเก็บ time ก่อน
    foreach ($result2 as $value) {

        $keep = explode("T", $value["timestamp"]);
        $keep = explode(".", $keep[1]);
        $keep = explode(":", $keep[0]);
        $keep_spacing = (int)($keep[1]);
        $keep = $keep[0] . ':' . $keep[1];
        
        // echo $keep[1] . "<br>";
        if( ($keep_spacing % $timeSpacing_cal) == 0){
            if( !(in_array($keep, $time_chart)) ){
                array_push($time_chart, $keep);
                array_push($count_bus1, 0);
                array_push($max_peopleInbus1, 0);
                array_push($count_bus3, 0);
                array_push($max_peopleInbus3, 0);
    
                array_push($num_seat1, 0);
                array_push($num_seat3, 0);
            }
        }

      
    }
    foreach ($result3 as $value) {

        $keep = explode("T", $value["timestamp"]);
        $keep = explode(".", $keep[1]);
        $keep = explode(":", $keep[0]);
        $keep = $keep[0] . ':' . $keep[1];

        $index_time = array_search($keep, $time_chart);
     
        if($index_time != ''){
            if($value["route"] == '1' && $value["speed"] != '0.0'){
                $count_bus1[$index_time] = $count_bus1[$index_time] + 1;
                $max_peopleInbus1[$index_time] = $max_peopleInbus1[$index_time] + (int)$value["passenger"];
            }elseif($value["route"] == '3' && $value["speed"] != '0.0'){
                $count_bus3[$index_time] = $count_bus3[$index_time] + 1;
                $max_peopleInbus3[$index_time] = $max_peopleInbus3[$index_time] + (int)$value["passenger"];
            }
        }
       
     
    
    }
    //======= วนหาจำนวนที่นั่งที่ว่าง ========================
    $i = 0;
    foreach ($time_chart as $value) {
        if($route_1 == '1' && $route_3 != '3'){
            $num_seat1[$i] = ($count_bus1[$i] * 13) - $max_peopleInbus1[$i];
        }
        elseif($route_3 == '3' && $route_1 != '1'){
            $num_seat3[$i] = ($count_bus3[$i] * 13) - $max_peopleInbus3[$i];
        }else{
            $num_seat1[$i] = ($count_bus1[$i] * 13) - $max_peopleInbus1[$i];
            $num_seat3[$i] = ($count_bus3[$i] * 13) - $max_peopleInbus3[$i];
        }
        $i = $i + 1;
    }

    // ทำเป็น str เพื่อเเสดง chart
    $i = 0;
    $time_chart_str = '';
    $count_bus_str1 = '';
    $count_bus_str3 = '';
    $max_peopleInbus_str1 = '';
    $max_peopleInbus_str3 = '';

    $num_seat_str1 = '';
    $num_seat_str3 = '';

    $Ratio_numSeat_numP1 = '';
    $Ratio_numSeat_numP3 = '';

    foreach ($time_chart as $value) {
        
        $time_chart_str = $time_chart_str .'"'.$value.'",';

        $num_seat_str1 = $num_seat_str1 .'"'. $num_seat1[$i]   .'",';
        $num_seat_str3 = $num_seat_str3 .'"'. $num_seat3[$i]   .'",';

        $Calmax_peopleInbus1 = $max_peopleInbus1[$i];
        $Calmax_peopleInbus3 = $max_peopleInbus3[$i];
        if($max_peopleInbus1[$i] == 0){
            $Calmax_peopleInbus1 = 1;
        }
        if($max_peopleInbus3[$i] == 0){
            $Calmax_peopleInbus3 = 1;
        }
        // --------------------------------------------------------------------------------

        if($route_1 == '1' && $route_3 != '3'){
            $count_bus_str1 = $count_bus_str1 .'"'. $count_bus1[$i]   .'",';
            $max_peopleInbus_str1 = $max_peopleInbus_str1 .'"'. $max_peopleInbus1[$i]   .'",';

            $keep_Ratio_numSeat_num1 = ($count_bus1[$i] * 13) / $Calmax_peopleInbus1;
            $Ratio_numSeat_numP1 = $Ratio_numSeat_numP1 .'"'. number_format($keep_Ratio_numSeat_num1, 0) .'",';
        }
        elseif($route_3 == '3' && $route_1 != '1'){
            $count_bus_str3 = $count_bus_str3 .'"'. $count_bus3[$i]   .'",';
            $max_peopleInbus_str3 = $max_peopleInbus_str3 .'"'. $max_peopleInbus3[$i]   .'",';

            $keep_Ratio_numSeat_num3 = ($count_bus3[$i] * 13) / $Calmax_peopleInbus3;
            $Ratio_numSeat_numP3 = $Ratio_numSeat_numP3 .'"'. number_format($keep_Ratio_numSeat_num3, 0) .'",';
        }else{
            $count_bus_str1 = $count_bus_str1 .'"'. $count_bus1[$i]   .'",';
            $max_peopleInbus_str1 = $max_peopleInbus_str1 .'"'. $max_peopleInbus1[$i]   .'",';
            $count_bus_str3 = $count_bus_str3 .'"'. $count_bus3[$i]   .'",';
            $max_peopleInbus_str3 = $max_peopleInbus_str3 .'"'. $max_peopleInbus3[$i]   .'",';
            
            $keep_Ratio_numSeat_num1 = ($count_bus1[$i] * 13) / $Calmax_peopleInbus1;
            $keep_Ratio_numSeat_num3 = ($count_bus3[$i] * 13) / $Calmax_peopleInbus3;
            $Ratio_numSeat_numP1 = $Ratio_numSeat_numP1 .'"'. number_format($keep_Ratio_numSeat_num1, 0) .'",';
            $Ratio_numSeat_numP3 = $Ratio_numSeat_numP3 .'"'. number_format($keep_Ratio_numSeat_num3, 0) .'",';
        }   
        
        $i = $i + 1;
    }
    // ตัด ',' ตัวสุดท้ายออก
    $time_chart_str = trim($time_chart_str,",");
    $count_bus_str1 = trim($count_bus_str1,",");
    $max_peopleInbus_str1 = trim($max_peopleInbus_str1,",");
    $count_bus_str3 = trim($count_bus_str3,",");
    $max_peopleInbus_str3 = trim($max_peopleInbus_str3,",");

    $num_seat_str1 = trim($num_seat_str1,",");
    $num_seat_str3 = trim($num_seat_str3,",");

    $Ratio_numSeat_numP1 = trim($Ratio_numSeat_numP1,",");
    $Ratio_numSeat_numP3 = trim($Ratio_numSeat_numP3,",");

?>