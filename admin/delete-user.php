<?php

require_once "./conn.php";

if($_SESSION["user_role"] == '0')
{
    header("Location:".$host."post.php");
}

$userid =  $_GET['id'];

$sql = "DELETE FROM user WHERE `user_id`='$userid'";

if(mysqli_query($conn, $sql))
{
    header("Location:".$host."users.php");
}
else
{
    echo "<p style='color:red; margine: 10px 0;'> Can\'t Delete the Record...!!! </p>";
}

mysql_close($conn);

?>