<?php include 'header.php';

require_once "./conn1.php";

?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">

                    <?php

                    $post_id = $_GET['id'];

                    $sql = "SELECT post.post_id, post.title, post.description, post.post_date,post.author,
                            category.category_name, user.username, post.category, post.post_img 
                            FROM `post` 
                            LEFT JOIN `category` ON post.category = category.category_id 
                            LEFT JOIN `user` ON post.author = user.user_id 
                            WHERE post.post_id = {$post_id}";

                            $result = mysqli_query($conn, $sql) or die("Query Failed...!!");
                            if(mysqli_num_rows($result) > 0)
                            {
                                // $sno=$offset+1;
                                    while($data = mysqli_fetch_assoc($result))
                                    {
                ?>
                        <div class="post-content single-post">
                            <h3> <?php echo $data['title'];?> </h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                         <a href='category.php?cid=<?php echo $data['category'];?>'><?php echo $data['category_name'];?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aid=<?php echo $data['author'];?>'> <?php echo $data['username'];?> </a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $data['post_date'];?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $data['post_img'];?>" alt=""/>
                            <p class="description">
                                <?php echo $data['description'];?>
                            </p>
                        </div>
                        <?php
                                    }
                            }        
                        ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
