<?php
require 'connect.php';



$rss_urls = [
    'tech' => 'https://timesofindia.indiatimes.com/rssfeeds/66949542.cms',
    'cricket' => 'https://timesofindia.indiatimes.com/rssfeeds/54829575.cms',
    'science' => 'https://timesofindia.indiatimes.com/rssfeeds/-2128672765.cms'
];
$flag=0;

foreach ($rss_urls as $category_name => $url) {

    $result = mysqli_query($conn, "SELECT id FROM categories WHERE name = '$category_name'");
    if ($row = mysqli_fetch_assoc($result)) {
        $category_id = $row['id'];
    }
    //cheak
     $cheak = mysqli_query($conn, "SELECT * FROM rss_urls WHERE category_id = '$category_id'");
    if (mysqli_num_rows($cheak) > 0) {
        echo "$category_name " . "Url already exist" . "<br>";
        continue;
    } else {
       $sql = "INSERT INTO `rss_urls`( `url`, `category_id`) VALUES ('$url','$category_id')";
       $result = mysqli_query($conn, $sql);
       $flag = 1;
    }

}
if($flag==1){
    echo "Data inserted successfully";
}else{
    echo "Data not inserted";
}


?>