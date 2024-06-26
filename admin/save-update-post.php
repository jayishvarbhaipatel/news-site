<?php

require_once "./conn.php";

if(empty($_FILES['new-image']['name']))
{
    $file_name = $_POST['old-image'];
}
else
{
    $errors = array();
    
    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = end(explode(".",$file_name));
    $extensions = array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions) === false)
    {
        $errors[] ="This extension File does not allowed..!!, Please choose a JPG or PNG file.";
    }

    if($file_size > 2097152)
    {
        $errors[] = "File must be Less than 2MB";
    }

    if(empty($errors) == true)
    {
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }
    else
    {
        print_r($errors);
        die();
    }
}

    $sql = "UPDATE post SET `title`='{$_POST["post_title"]}', `description`='{$_POST["postdesc"]}', `category`={$_POST["category"]}, `post_img`='{$file_name}'
            WHERE `post_id`={$_POST["post_id"]};";

            if($_POST['old_category'] != $_POST["category"])
            {
                $sql .= "UPDATE `category` SET `post` = post - 1 WHERE `category_id` = {$_POST['old_category']};"; 
                $sql .= "UPDATE `category` SET `post` = post + 1 WHERE `category_id` = {$_POST["category"]};"; 
            }
            
    $result =mysqli_multi_query($conn, $sql);

    if($result)
    {
        header("Location:".$host."post.php");
    }    
    else
    {
        echo "Query Failed...!!!";
    }
?>