<?php

$hostname="localhost";
$dbname="id22091103_news";
$db_uname="id22091103_news";
$db_pass="Jaypatel#5345";

$host = "https://jaypatelnewsproject.000webhostapp.com/";

$host1 = "https://jaypatelnewsproject.000webhostapp.com/";

$conn = mysqli_connect($hostname,$db_uname,$db_pass,$dbname);

if($conn)
{
    // echo "Connection Successfull";
}
else    
{
    echo "Connection Failed..!!!";
}

?>
