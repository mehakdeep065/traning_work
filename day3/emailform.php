<?php
include '../connect.php';
session_start();
if(isset($_SESSION['success'])){
     echo '<div class="justify-center flex">'.$_SESSION['success'].'</div>';
     unset($_SESSION['success']);
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "INSERT INTO `subscriber`( `name`, `email`) VALUES ('$name','$email')";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo "data inserted ";
    }
    else{
     echo "data not insertd";
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
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br>
            <input type="submit" name="submit" value="submit">
        </form>
    </div>
</body>
</html>