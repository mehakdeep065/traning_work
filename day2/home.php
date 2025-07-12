<?php
session_start();
if(isset($_SESSION['success'])){
     echo '<div class="justify-center flex">'.$_SESSION['success'].'</div>';
     unset($_SESSION['success']);
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
        <h1>Home page</h1>
        <p>Want to signup</p>
        <button><a href="userlogin.php">Signup</a></button>
        
    </div>
</body>
</html>