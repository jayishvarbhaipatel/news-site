<?php include "header.php"; 

require_once "./conn.php";

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">

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
                
                $offset = ($page -1 ) * $limit;


                $sql = "SELECT * FROM `category` ORDER BY `category_id` DESC LIMIT $offset,$limit ";
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0)
                        {
                ?>
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
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
                            <td><?php echo $data['category_name']; ?></td>
                            <td><?php echo $data['post']; ?></td>
                            <td class='edit'><a href="update-category.php?id=<?php echo $data['category_id']; ?>"><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href="delete-category.php?id=<?php echo $data['category_id']; ?>)"><i class='fa fa-trash-o'></i></a></td>
                        </tr>

                        <?php 
                        $sno++;
                            }
                        ?>

                    </tbody>
                </table>

                <?php
                    }

                    $sql1 = "SELECT * FROM category";
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
                            echo '<li><a href="category.php?page='.($page - 1).'">Previous</a></li>';
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
                            echo "<li class='".$active."'><a href='category.php?page=$i'>$i</a></li>";
                        }

                        if($total_page > $page)
                        {
                            echo '<li><a href="category.php?page='.($page + 1).'">Next</a></li>';
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

                    function deletedata(id)     
                    {
                        $confirm = confirm("Do you want to Delete Data...???");

                        if($confirm)
                        {
                            window.location.href="delete-category.php?id="+id;
                        }
                    }
            
                </script>
