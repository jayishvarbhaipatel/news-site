<?php

require_once "./conn.php";

$postid =  $_GET['id'];

$cat_id = $_GET['catid'];

$sql1 = "SELECT * FROM `post` WHERE `post_id`='$postid';";
$result = mysqli_query($conn, $sql1) or die("Query Failed..! : SELECT");
$data = mysqli_fetch_assoc($result);

unlink("upload/".$data['post_img']);

$sql = "DELETE FROM `post` WHERE `post_id`='$postid';";

$sql .= "UPDATE `category` SET `post` = post-1 WHERE `category_id` = {$cat_id}";

if(mysqli_multi_query($conn, $sql))
{
    header("Location:".$host."post.php");
}
else
{
    echo "<p style='color:red; margine: 10px 0;'> Can\'t Delete the Record...!!! </p>";
}

mysql_close($conn);

?>