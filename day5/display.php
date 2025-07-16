<?php
require 'connect.php';

$url = "https://timesofindia.indiatimes.com/rssfeeds/54829575.cms";
$category_name = "cricket"; 

$cat_result = mysqli_query($conn, "SELECT id FROM categories WHERE name = '$category_name'");
$cat_row = mysqli_fetch_assoc($cat_result);
$cate_id = $cat_row['id']; // This will be used in news table

$url_data = simplexml_load_file($url);
$feedArr = json_decode(json_encode($url_data),true);
//     echo "<pre>";
//    print_r( $feedArr['channel']);
if(isset($feedArr['channel'])){
    if (isset($feedArr['channel']['item'])) {
        foreach($feedArr['channel']['item'] as $list){
            echo "<div style='width=50'>";
            // echo "<h4><a href= ' ".$list['link']." ' >".$list['title']."</a></h4>";
            // echo "<h4><a href= ' ".$list['link']." ' >".$list['link']."</a></h4><br>";
            // echo "<h4><a href= '  ' >".$list['description']."</a></h4><br>";
           
            echo "</div>";

            $list_title = $list['title'];
            $list_link = $list['link'];
            $list_des = strip_tags($list['description']);
            $list_description = mysqli_real_escape_string($conn,$list_des);
            echo $list_des;
            
            $res = mysqli_query($conn,"INSERT INTO `news`(`title`, `description`, `link`,`category_id`) VALUES ('$list_title','$list_description','$list_link','$cate_id')");
            if($res){
            echo "Data Inserted";
            }
           
        }
    }
    else{
        echo "No items found";
    }
}else{
    echo "No data found";
}

?>