<?php
require 'connect.php';
session_start();

if(isset($_POST['submit'])){
    $cat = $_POST['category'];
    
    $cheak = mysqli_query($conn, "SELECT * FROM categories WHERE name = '$cat'");
    if (mysqli_num_rows($cheak) > 0) {
        $_SESSION['cate'] = $cat;
        header('location:display.php');
        echo "$cat " . "Category already exist" . "<br>";
       
    } else {
        $sql = "INSERT INTO `categories`(`name`) VALUES ('$cat')";
        $result = mysqli_query($conn, $sql);
        $_SESSION["success"] =  "$cat " . "Category inserted successfully" . "<br>";
        $_SESSION['cate'] = $cat;
        header('location:url_insert.php');
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
</head>
<body>
    <form method="post">
        <label for="category">Add Category: </label>
        <input type="text" name="category">
        <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>