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

                    if(isset($_GET['search']))
                    {
                        $search_term = mysqli_real_escape_string($conn, $_GET['search']);
                    }

                    $auth_id = $_GET['search'];

                    ?>

                <h2 class='page-heading'>Search :<?php echo $search_term;?></h2>

                <?php 

                $limit =3;

                if (isset($_GET['page']))
                {
                    $page = $_GET['page'];
                }
                else
                {
                    $page=1;
                }

                $offset = ($page - 1) * $limit;

                $sql = "SELECT post.post_id, post.title, post.description, post.post_date,post.author,
                        category.category_name, user.username, post.category, post.post_img FROM `post` 
                        LEFT JOIN `category` ON post.category = category.category_id 
                        LEFT JOIN `user` ON post.author = user.user_id
                        WHERE post.title LIKE '%$search_term%'
                        ORDER BY post.post_id DESC LIMIT $offset,$limit";

                        $result = mysqli_query($conn, $sql) or die("Query Failed...!!");
                        if(mysqli_num_rows($result) > 0)
                        {
                            $sno=$offset+1;
                                while($data = mysqli_fetch_assoc($result))
                                {
                ?>

                                
        <div class="post-content">
            <div class="row">
                <div class="col-md-4">
                    <a class="post-img" href="single.php?id=<?php echo $data['post_id'];?>"><img src="admin/upload/<?php echo $data['post_img'];?>" alt=""/></a>
                </div>
                <div class="col-md-8">
                    <div class="inner-content clearfix">
                        <h3><a href='single.php?id=<?php echo $data['post_id'];?>'> <?php echo $data['title'];?> </a></h3>
                        <div class="post-information">
                            <span>
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                <a href='category.php'> <?php echo $data['category_name'];?> </a>
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
                        <p class="description">
                            <?php echo substr($data['description'],0,120) . "...";?>
                        </p>
                        <a class='read-more pull-right' href='single.php?id=<?php echo $data['post_id'];?>'>read more</a>
                    </div>
                </div>
            </div>
        </div>
                                        
    <?php

            }
        }        
    ?>
        <?php

        $sql1 = "SELECT * FROM `post` 
                WHERE post.title LIKE '%$search_term%'";
        $result1 = mysqli_query($conn, $sql1);

    if(mysqli_num_rows($result1) > 0)
    {
        $total_records = mysqli_num_rows($result1);
    
        $total_page = ceil($total_records/$limit);
    
        echo "<ul class='pagination admin-pagination'>";
        if($page > 1)
        {
            echo "<li><a href='category.php?search='.$search_term .'&page='.($page-1).'>Previous</a></li>";
        }
        
        // $i;
        for($i = 1;$i <= $total_page; $i++)
        {
            if($i == $page)
            {
                $active = "active";
            }
            else
            {
                $active = "";
            }
            echo "<li class='".$active."'><a href='category.php?search=$search_term &page=$i'>$i</a></li>";
        }
    
        if($total_page > $page)
        {
            echo '<li><a href="category.php?search='.$search_term .'&page='.($page+1).'">Next</a></li>';
        }
        echo "</ul>";
    }
    else
    {
        echo "Record Not Found...!!";
    }
?>

                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
