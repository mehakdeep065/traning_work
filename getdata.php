<?php
require 'connect.php';

$sql = "SELECT * FROM `reminders`";
$result = mysqli_query($conn, $sql);

// $current_time = date("H:i:s"); 
$current_time = "09:05:00";

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $time = $row['time'];
        $message = $row['messages'];
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