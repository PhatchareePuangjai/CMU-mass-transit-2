<?php

    // run composer ใน cmd ก่อน ---> composer require "mongodb/mongodb=^1.0.0"
    require 'vendor/autoload.php'; // include Composer's autoloader
    $client = new MongoDB\Client("mongodb://cmuuser:cmuuserp%40ssw0rd@27.254.90.146:27017/?authSource=timesyscmu");
    
?>