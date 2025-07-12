<?php 
include "../connect.php";
if(isset($_POST['submit'])){
    $time = $_POST['time'];
    $text = $_POST['text'];
    $sql ="INSERT INTO `reminders`( `messages`, `time`) VALUES ('$text','$time')";
    $result = mysqli_query($conn, $sql);
    if($result){
    echo "Reminder Added";
    }
    else{
        echo "Error";
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <form method="post">
            <input type="time" name="time" id="time">
            <input type="text" name="text" id="text">
            <input type="submit" name="submit" value="submit">
        </form>
    </div>
</body>

</html>