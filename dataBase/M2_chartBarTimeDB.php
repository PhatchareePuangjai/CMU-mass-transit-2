<?php

    //========= include =========
    include 'config.inc.php';

    //==== value ====
    $timeBus_avg_Mo1 = new ArrayObject(array());
    $timeBus_avg_Tu1 = new ArrayObject(array());
    $timeBus_avg_We1 = new ArrayObject(array());
    $timeBus_avg_Th1 = new ArrayObject(array());
    $timeBus_avg_Fr1 = new ArrayObject(array());
    $timeBus_avg_Sa1 = new ArrayObject(array());
    $timeBus_avg_Su1 = new ArrayObject(array());

    $timeBus_avg_Mo3 = new ArrayObject(array());
    $timeBus_avg_Tu3 = new ArrayObject(array());
    $timeBus_avg_We3 = new ArrayObject(array());
    $timeBus_avg_Th3 = new ArrayObject(array());
    $timeBus_avg_Fr3 = new ArrayObject(array());
    $timeBus_avg_Sa3 = new ArrayObject(array());
    $timeBus_avg_Su3 = new ArrayObject(array());

    $count_numBus = new ArrayObject(array());

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
            if($count_numBus[$i] != 0){
                $timeBus_avg[$i] = ceil($timeBus_avg[$i] / $count_numBus[$i]);
            }
            
        }
        return $timeBus_avg;

    }

    $time_star1 = ['07:00', '08:01', '09:31', '11:01', '12:31', '13:01', '14:31', '16:01', '17:31', '19:01', '20:31'];
    $time_end1 =  ['08:00', '09:30', '11:00', '12:30', '13:00', '14:30', '16:00', '17:30', '19:00', '20:30', '22:00']; 
    $timeBus_avg = '';

    for( $i = 0; $i < 11; $i++ ) {
        $keep = $time_star1[$i] . ' - ' .$time_end1[$i];
        $timeBus_avg = $timeBus_avg .'"'. $keep   .'",';

        $count_numBus->append(0);

        $timeBus_avg_Mo1->append(0);
        $timeBus_avg_Tu1->append(0);
        $timeBus_avg_We1->append(0);
        $timeBus_avg_Th1->append(0);
        $timeBus_avg_Fr1->append(0);
        $timeBus_avg_Sa1->append(0);
        $timeBus_avg_Su1->append(0);

        $timeBus_avg_Mo3->append(0);
        $timeBus_avg_Tu3->append(0);
        $timeBus_avg_We3->append(0);
        $timeBus_avg_Th3->append(0);
        $timeBus_avg_Fr3->append(0);
        $timeBus_avg_Sa3->append(0);
        $timeBus_avg_Su3->append(0);

        
    }

    $building = $_REQUEST['building'];
 
    $timeBus_avg_Mo1 = detDataDay($building, 'Monday', $timeBus_avg_Mo1, $count_numBus, '1');
    $timeBus_avg_Tu1 = detDataDay($building, 'Tuesday', $timeBus_avg_Tu1, $count_numBus, '1');
    $timeBus_avg_We1 = detDataDay($building, 'Wednesday', $timeBus_avg_We1, $count_numBus, '1');
    $timeBus_avg_Th1 = detDataDay($building, 'Thursday', $timeBus_avg_Th1, $count_numBus, '1');
    $timeBus_avg_Fr1 = detDataDay($building, 'Friday', $timeBus_avg_Fr1, $count_numBus, '1');
    $timeBus_avg_Sa1 = detDataDay($building, 'Saturday', $timeBus_avg_Sa1, $count_numBus, '1');
    $timeBus_avg_Su1 = detDataDay($building, 'Sunday', $timeBus_avg_Su1, $count_numBus, '1');

    $timeBus_avg_Mo3 = detDataDay($building, 'Monday', $timeBus_avg_Mo3, $count_numBus, '3');
    $timeBus_avg_Tu3 = detDataDay($building, 'Tuesday', $timeBus_avg_Tu3, $count_numBus, '3');
    $timeBus_avg_We3 = detDataDay($building, 'Wednesday', $timeBus_avg_We3, $count_numBus, '3');
    $timeBus_avg_Th3 = detDataDay($building, 'Thursday', $timeBus_avg_Th3, $count_numBus, '3');
    $timeBus_avg_Fr3 = detDataDay($building, 'Friday', $timeBus_avg_Fr3, $count_numBus, '3');
    $timeBus_avg_Sa3 = detDataDay($building, 'Saturday', $timeBus_avg_Sa3, $count_numBus, '3');
    $timeBus_avg_Su3 = detDataDay($building, 'Sunday', $timeBus_avg_Su3, $count_numBus, '3');

    // value string
    $StimeBus_avg_Mo1 = '';
    $StimeBus_avg_Tu1 = '';
    $StimeBus_avg_We1 = '';
    $StimeBus_avg_Th1 = '';
    $StimeBus_avg_Fr1 = '';
    $StimeBus_avg_Sa1 = '';
    $StimeBus_avg_Su1 = '';

    $StimeBus_avg_Mo3 = '';
    $StimeBus_avg_Tu3 = '';
    $StimeBus_avg_We3 = '';
    $StimeBus_avg_Th3 = '';
    $StimeBus_avg_Fr3 = '';
    $StimeBus_avg_Sa3 = '';
    $StimeBus_avg_Su3 = '';

    for( $i = 0; $i < 11; $i++ ) {
        $StimeBus_avg_Mo1 =  $StimeBus_avg_Mo1 .'"'. $timeBus_avg_Mo1[$i]   .'",';
        $StimeBus_avg_Tu1 =  $StimeBus_avg_Tu1 .'"'. $timeBus_avg_Tu1[$i]   .'",';
        $StimeBus_avg_We1 =  $StimeBus_avg_We1 .'"'. $timeBus_avg_We1[$i]   .'",';
        $StimeBus_avg_Th1 =  $StimeBus_avg_Th1 .'"'. $timeBus_avg_Th1[$i]   .'",';
        $StimeBus_avg_Fr1 =  $StimeBus_avg_Fr1 .'"'. $timeBus_avg_Fr1[$i]   .'",';
        $StimeBus_avg_Sa1 =  $StimeBus_avg_Sa1 .'"'. $timeBus_avg_Sa1[$i]   .'",';
        $StimeBus_avg_Su1 =  $StimeBus_avg_Su1 .'"'. $timeBus_avg_Su1[$i]   .'",';

        $StimeBus_avg_Mo3 =  $StimeBus_avg_Mo3 .'"'. $timeBus_avg_Mo3[$i]   .'",';
        $StimeBus_avg_Tu3 =  $StimeBus_avg_Tu3 .'"'. $timeBus_avg_Tu3[$i]   .'",';
        $StimeBus_avg_We3 =  $StimeBus_avg_We3 .'"'. $timeBus_avg_We3[$i]   .'",';
        $StimeBus_avg_Th3 =  $StimeBus_avg_Th3 .'"'. $timeBus_avg_Th3[$i]   .'",';
        $StimeBus_avg_Fr3 =  $StimeBus_avg_Fr3 .'"'. $timeBus_avg_Fr3[$i]   .'",';
        $StimeBus_avg_Sa3 =  $StimeBus_avg_Sa3 .'"'. $timeBus_avg_Sa3[$i]   .'",';
        $StimeBus_avg_Su3 =  $StimeBus_avg_Su3 .'"'. $timeBus_avg_Su3[$i]   .'",';
    }
    $timeBus_avg = trim($timeBus_avg,",");
    $StimeBus_avg_Mo1 = trim($StimeBus_avg_Mo1,",");
    $StimeBus_avg_Tu1 = trim($StimeBus_avg_Tu1,",");
    $StimeBus_avg_We1 = trim($StimeBus_avg_We1,",");
    $StimeBus_avg_Th1 = trim($StimeBus_avg_Th1,",");
    $StimeBus_avg_Fr1 = trim($StimeBus_avg_Fr1,",");
    $StimeBus_avg_Sa1 = trim($StimeBus_avg_Sa1,",");
    $StimeBus_avg_Su1 = trim($StimeBus_avg_Su1,",");

    $StimeBus_avg_Mo3 = trim($StimeBus_avg_Mo3,",");
    $StimeBus_avg_Tu3 = trim($StimeBus_avg_Tu3,",");
    $StimeBus_avg_We3 = trim($StimeBus_avg_We3,",");
    $StimeBus_avg_Th3 = trim($StimeBus_avg_Th3,",");
    $StimeBus_avg_Fr3 = trim($StimeBus_avg_Fr3,",");
    $StimeBus_avg_Sa3 = trim($StimeBus_avg_Sa3,",");
    $StimeBus_avg_Su3 = trim($StimeBus_avg_Su3,",");

    
?>