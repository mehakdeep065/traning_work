<?php
require 'connect.php';
session_start();
if (isset($_SESSION["success"])) {
    echo $_SESSION["success"];
}

if (isset($_POST['submit'])) {
    $category_name = $_POST['category_name'];
    $url = $_POST['url'];

    $flag = 0;
    $result = mysqli_query($conn, "SELECT id FROM categories WHERE name = '$category_name'");
    if ($row = mysqli_fetch_assoc($result)) {
        $category_id = $row['id'];
    } else {
        header('location:category.php');
        exit();
    }

    //cheak
    $cheak = mysqli_query($conn, "SELECT * FROM rss_urls WHERE category_id = '$category_id'");
    if (mysqli_num_rows($cheak) > 0) {
        $_SESSION['exist'] = "$category_name " . "category and Url already exist" . "<br>";
        header('location:display.php');

    } else {
        $sql = "INSERT INTO `rss_urls`( `url`, `category_id`) VALUES ('$url','$category_id')";
        $result = mysqli_query($conn, $sql);
        $flag = 1;
    }


    if ($flag == 1) {
        echo "Data inserted successfully";
    } else {
        echo "Data not inserted";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add urls</title>
</head>

<body>
    <form method="post">
        <?php
        if(isset($_SESSION["cate"])){
            echo "<label for='category_name'>Category Name:</label>";
            echo '<input type="text" value="'.$_SESSION['cate'].'"'.'name="category_name"><br>';
            
        }
        else{
            echo "<label for='category_name'>Category Name:</label>";
            echo '<input type="text" id="category_name" name="category_name"><br>';
        }
        
        ?>
        <label for="url">Url:</label>
        <input type="text" id="url" name="url"><br>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>

</html>