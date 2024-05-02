<?php

require_once "./conn1.php";

?>
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php 

                $sql = "SELECT * FROM `settings`";

                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0)
                {
                    while($data = mysqli_fetch_assoc($result))
                    {
            ?>
                <span> <?php echo $data['footerdesc'];?> </span>

                <?php
                    }
                }    
                ?>

            </div>
        </div>
    </div>
</div>
</body>
</html>
