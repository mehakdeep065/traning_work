<?php
require 'connect.php';
$query = "
SELECT 
    c.id AS category_id,
    c.name AS category_name,
    r.url AS url
FROM categories c
JOIN rss_urls r ON c.id = r.category_id
";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $cate_id = $row['category_id'];
    $category_name = $row['category_name'];
    $url = $row['url'];

    $url_data = @simplexml_load_file($url);
    if (!$url_data) {
        echo "data not found";
        continue;
    }
    $feedArr = json_decode(json_encode($url_data),true);
    if (isset($feedArr['channel']['item'])) {
        foreach ($feedArr['channel']['item'] as $list) {
            $list_title = mysqli_real_escape_string($conn, $list['title']);
            $list_link = mysqli_real_escape_string($conn, $list['link']);
            $list_des = mysqli_real_escape_string($conn, strip_tags($list['description']));

            //cheak 
            $check = mysqli_query($conn, "SELECT * FROM news WHERE title = '$list_title'");
            if (mysqli_num_rows($check) > 0) {
                echo "already exist news $list_title "."\n";
                continue;
            }
            //insert
            $insert = mysqli_query($conn, "INSERT INTO `news`( `title`, `description`, `link`, `category_id`, `category_name`) VALUES ('$list_title','$list_des','$list_link','$cate_id','$category_name')");
            if ($insert) {
                echo "<pre>";
                echo "Inserted: $list_title "."<br>";
            }
        }

    }
}

?>