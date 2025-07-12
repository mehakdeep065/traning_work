<?php
require 'connect.php';

$sql = "SELECT * FROM `reminders`";
$result = mysqli_query($conn, $sql);

// $current_time = date("H:i:s"); 
$current_time = "18:00:00";

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $time = trim($row['time']);
        $message = $row['messages'];
        echo "DB: [$time] - Current: [$current_time]<br>";
        if ($time == $current_time) {
            echo "<script>alert('{$message}');</script>";
        }
        echo $time . "<br>";
        echo $message . "<br>";
    }

} else {
    echo "fail";
}
?>