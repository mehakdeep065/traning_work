<?php 
require 'connect.php';
$currentTime = date("H:i");
// $currentTime = "09:10";
 $reminders = [
    "09:05" => " Good morning! Time to start your top task. Let's win the day!",
    "09:10" => " Focus check! Are you making real progress?",
    "14:00" => " Mid-day boost: One task. Full power. Go!",
    "18:00" => " Great work! Review your day and prep for tomorrow."
];

foreach ($reminders as $time => $message) {
    $safe_message = mysqli_real_escape_string($conn, $message);
    $safe_time = mysqli_real_escape_string($conn, $time);
    $sql = "INSERT INTO `reminders`(`messages`, `time`) VALUES ('$safe_message', '$safe_time')";
    $result = mysqli_query($conn, $sql);
}
  if($result){
        echo "Reminders added"; 
    }
    else{
        echo "Error adding reminders";
    }

?>
