<?php
require 'connect.php';

$category = ['tech', 'cricket', 'science', ];

foreach ($category as $cat) {
    $cheak = mysqli_query($conn, "SELECT * FROM categories WHERE name = '$cat'");
    if (mysqli_num_rows($cheak) > 0) {
        echo "$cat " . "Category already exist" . "<br>";
        continue;
    } else {
        $sql = "INSERT INTO `categories`(`name`) VALUES ('$cat')";
        $result = mysqli_query($conn, $sql);
        echo  "$cat " . "Category inserted successfully" . "<br>";
    }

}

?>