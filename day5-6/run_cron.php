<?php

while(true){
    echo "Running cron.php at " . date("Y-m-d H:i:s") . "\n";
    include 'cron.php';
    $hours = 12*60*60;
    sleep($hours);
}

?>