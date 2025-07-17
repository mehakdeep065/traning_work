<?php
require 'connect.php';
session_start();
if (isset($_POST['submit'])) {
    $category_name = $_POST['category'];
    $cat_result = mysqli_query($conn, "SELECT id FROM categories WHERE name = '$category_name'");
    $cat_row = mysqli_fetch_assoc($cat_result);
    $cate_id = $cat_row['id'];
    $cat_url = mysqli_query($conn, "SELECT * FROM rss_urls WHERE category_id = '$cate_id'");
    $url_row = mysqli_fetch_assoc($cat_url);
    $url = $url_row['url'];

    $url_data = simplexml_load_file($url);
    $feedArr = json_decode(json_encode($url_data), true);
    //     echo "<pre>";
//    print_r( $feedArr['channel']['item']);
    if (isset($feedArr['channel'])) {
        if (isset($feedArr['channel']['item'])) {
            foreach ($feedArr['channel']['item'] as $list) {
                echo "<div style='width=50'>";
                // echo "<h4><a href= ' ".$list['link']." ' >".$list['title']."</a></h4>";
                // echo "<h4><a href= ' ".$list['link']." ' >".$list['link']."</a></h4><br>";
                // echo "<h4><a href= '  ' >".$list['description']."</a></h4><br>";

                echo "</div>";

                $list_title = mysqli_real_escape_string($conn, $list['title']);
                $list_link = mysqli_real_escape_string($conn, $list['link']);

                $list_des = mysqli_real_escape_string($conn, strip_tags($list['description']));

                //cheak
                $res = mysqli_query($conn, "select * from `news`  where title = '$list_title'");
                if (mysqli_num_rows($res) > 0) {
                    echo "<a href='$list_link'>$list_title</a>";
                    continue;
                } else {
                    $res = mysqli_query($conn, "INSERT INTO `news`(`title`, `description`, `link`,`category_id`,`category_name`) VALUES ('$list_title','$list_des','$list_link','$cate_id','$category_name')");
                    if ($res) {
                        echo "<a href='$list_link'>$list_title</a>";
                    }
                }

            }
        } else {
            echo "No items found";
        }
    } else {
        echo "No data found";
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
    <form method="post">
        <?php
        if (isset($_SESSION["cate"]) && isset($_SESSION['exist'])) {
            echo $_SESSION['exist'];
            echo "<label for='category'>Enter  Category name for view : </label>";
            echo '<input type="text" value="' . $_SESSION['cate'] . '"' . 'name="category"><br>';

        }
        ?>
        <input type="submit" value="submit" name="submit">
        <button><a href="category.php" >Add category</a></button>
        <button><a href="url_insert.php" >Add url</a></button>
        
       
    </form>
</body>

</html>