<?php include "header.php"; 

require_once "./conn.php";

if($_SESSION["user_role"] == '0')
{
    header("Location:".$host."post.php");
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                    
                    <?php

                        $limit = 5;

                        if (isset($_GET['page']))
                        {
                            $page = $_GET['page'];
                        }
                        else
                        {
                            $page=1;
                        }
                        
                        $offset = ($page -1 ) * $limit;

                        $sql = "SELECT * FROM `user` ORDER BY `user_id` DESC LIMIT $offset,$limit ";
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                    ?>
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
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
                              <td class='id'><?php echo $sno; ?></td>
                              <td><?php echo $data['first_name'] ." ".$data['last_name']; ?></td>
                              <td><?php echo $data['username']; ?></td>
                              <td><?php 
                              
                             if($data['role'] == 1)
                             {
                                echo "Admin";
                             }
                            else    
                             {
                                echo "Normal";
                             }

                              ?>
                              </td>
                              <td class='edit'><a href="update-user.php?id=<?php echo $data['user_id']; ?>"><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='javascript:void(0);' onclick="deletedata('<?php echo $data['user_id']; ?>')"><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          
                          <?php 
                          $sno++;
                            }
                          ?>
                          
                      </tbody>
                  </table>

                <?php
                    }

                    $sql1 = "SELECT * FROM user";
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
                            echo '<li><a href="users.php?page='.($page - 1).'">Previous</a></li>';
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
                            echo "<li class='".$active."'><a href='users.php?page=$i'>$i</a></li>";
                        }

                        if($total_page > $page)
                        {
                            echo '<li><a href="users.php?page='.($page + 1).'">Next</a></li>';
                        }
                        echo "</ul>";
                    }
                 ?>

                      <!-- <li class="active"><a>1</a></li> -->

              </div>
          </div>
      </div>
  </div>

                <script>

                    function deletedata(id)     
                    {
                        $confirm = confirm("Do you want to Delete Data...???");

                        if($confirm)
                        {
                            window.location.href="delete-user.php?id="+id;
                        }
                    }
            
                </script>
               

