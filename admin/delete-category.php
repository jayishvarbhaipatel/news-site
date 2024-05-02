<?php

require_once "./conn.php";

session_start();

if($_SESSION["user_role"] == '1')
{
    header("Location:".$host."post.php");
}

$userid =  $_GET['id'];

$sql = "DELETE FROM `category` WHERE category_id= {$category_id}";

if(mysqli_query($conn, $sql))
{
    header("Location:".$host."category.php");
}
else
{
    echo "<p style='color:red; margine: 10px 0;'> Can\'t Delete the Record...!!! </p>";
}

mysql_close($conn);

?>