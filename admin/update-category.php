<?php include "header.php"; 

require_once "./conn.php";

if($_SESSION["user_role"] == '0')
{
    header("Location:".$host."post.php");
}

if(isset($_POST['updatecat']))
{
    $cat_id = mysqli_real_escape_string($conn,$_POST['cat_id']);
    $cat_name = mysqli_real_escape_string($conn,$_POST['cat_name']);

    $sql = "UPDATE `category` SET  `category_name`='$cat_name' WHERE `category_id`='$cat_id'";

            if(mysqli_query($conn,$sql))
            {
                header("Location:".$host."category.php");
            }
    }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category </h1>
              </div>
              <div class="col-md-offset-3 col-md-6">

              <?php
                
                $category_id = $_GET['id'];
                $sql = "SELECT * FROM `category` WHERE category_id= '$category_id' ";

                $result = mysqli_query($conn, $sql)
                or 
                die("Query Failed..!!");
                if(mysqli_num_rows($result) > 0)
                {
                    while($data = mysqli_fetch_assoc($result))
                    {  
            ?>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value='<?php echo $data["category_id"]; ?>'>
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value='<?php echo $data["category_name"]; ?>'>
                      </div>
                      <input type="submit" name="updatecat" class="btn btn-primary" value="Update" required />
                  </form>

                  <?php
                    }
                 }
                  ?>

                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
