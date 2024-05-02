<?php require_once "./header.php"; 


require_once "./conn.php";

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">

              <?php

                    $limit =5;

                    if (isset($_GET['page']))
                    {
                        $page = $_GET['page'];
                    }
                    else
                    {
                        $page=1;
                    }

                    $offset = ($page - 1) * $limit;

                    if($_SESSION["user_role"] == '1')
                    {
                        $sql = "SELECT post.post_id, post.title, post.description, post.post_date,
                        category.category_name, user.username, post.category FROM `post` 
                        LEFT JOIN `category` ON post.category = category.category_id 
                        LEFT JOIN `user` ON post.author = user.user_id ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                    }
                    elseif($_SESSION["user_role"] == '0')
                    {
                        $sql = "SELECT post.post_id, post.title, post.description, post.post_date,
                        category.category_name, user.username, post.category FROM `post` 
                        LEFT JOIN `category` ON post.category = category.category_id 
                        LEFT JOIN `user` ON post.author = user.user_id 
                        WHERE post.author = {$_SESSION['user_id']} ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                    }

                    $result = mysqli_query($conn, $sql) or die("Query Failed...!!");
                    if(mysqli_num_rows($result) > 0)
                    {
             ?>
                        <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>

                      <?php
                            $sno=$offset+1;
                            while($data = mysqli_fetch_assoc($result))
                            {
                                
                        ?>
                          <tr>
                            
                              <td class='id'><?php echo $sno;?></td>
                              <td><?php echo $data['title'];?></td>
                              <td><?php echo $data['category_name'];?></td>
                              <td><?php echo $data['post_date'];?></td>
                              <td><?php echo $data['username'];?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $data['post_id'];?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $data['post_id']; ?>&catid=<?php echo $data["category"];?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>

                          <?php 
                          $sno++;
                            }
                          ?>

                      </tbody>
                  </table>
                  
                  <?php
                    }

                    $sql1 = "SELECT * FROM post";
                    $result1 = mysqli_query($conn, $sql1)
                    or
                    die("Query Falied...!!!");

                    if(mysqli_num_rows($result1) > 0)
                    {
                        $total_records = mysqli_num_rows($result1);
                        $total_page = ceil($total_records/$limit);

                        echo "<ul class='pagination admin-pagination'>";
                        if($page > 1)
                        {
                            echo '<li><a href="post.php?page='.($page - 1).'">Previous</a></li>';
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
                                $active = " ";
                            }
                            echo "<li class='".$active."'><a href='post.php?page=$i'>$i</a></li>";
                        }

                        if($total_page > $page)
                        {
                            echo '<li><a href="post.php?page='.($page + 1).'">Next</a></li>';
                        }
                        echo "</ul>";
                    }
                 ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>

                <script>

                    function deletedata(check)     
                    {
                        $confirm = confirm("Do you want to Delete Data...???");

                        if($confirm)
                        {
                            window.location.href="post.php?id="+id;
                        }
                    }
            
                </script>
